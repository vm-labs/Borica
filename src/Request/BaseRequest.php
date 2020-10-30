<?php

namespace Borica\Request;

use Borica\Entity\Request;
use Borica\Factory\RequestFactory;
use Borica\Manager\CertificateManager;
use Borica\Request\RequestInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use function bin2hex;
use function mt_rand;
use function openssl_random_pseudo_bytes;
use function str_pad;
use function strtoupper;

abstract class BaseRequest implements RequestInterface
{
    use CertificateManager;
    use RequestFactory;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    protected $config;

    abstract protected function init();
    abstract protected function getFormType(): string;
    abstract protected function getValidationGroup(): string;

    public function __construct(
        ValidatorInterface $validator,
        FormFactoryInterface $formFactory,
        Request $request,
        string $url,
        array $config
    ) {
        $this->validator = $validator;
        $this->formFactory = $formFactory;
        $this->request = $request;
        $this->url = $url;
        $this->config = $config;

        $this->init();
    }

    public function getData(): Request
    {
        return $this->request;
    }

    public function isValidData(): bool
    {
        return count($this->getErrorList($this->request)) === 0;
    }

    public function getErrorList(): ConstraintViolationList
    {
        return $this->validator->validate($this->request, null, ['Request', $this->getValidationGroup()]);
    }

    public function getForm(): Form
    {
        return $this->formFactory->createBuilder($this->getFormType(), $this->request, [
            'action' => $this->url,
        ])->getForm();
    }

    protected function signMessage()
    {
        $message = $this->getRequestMessage($this->request, $this->config['extended_mac']);
        $this->request->setSign($this->sign($message, $this->config));
    }

    protected function setDefaultData()
    {
        $this->request->setTerminal($this->config['terminal_id']);
        $this->request->setMerchant($this->config['merchant']);
        $this->request->setMerchantName($this->config['merchant_name']);
        $this->request->setMerchantUrl($this->config['merchant_url']);
        $this->request->setBackref($this->config['backref_url']);
        $this->request->setAddendum($this->request->getAddendum() ?? 'AD,TD');
        $this->request->setNonce($this->request->getNonce() ?? strtoupper(bin2hex(openssl_random_pseudo_bytes(16))));
        $this->request->setOrderId($this->request->getOrderId() ?? str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT));
        $this->request->setBoricaOrderId(
            $this->request->getBoricaOrderId() ??
            $this->request->getOrderId() . str_pad(mt_rand(0, 999999), 16, '0', STR_PAD_LEFT)
        );
    }
}
