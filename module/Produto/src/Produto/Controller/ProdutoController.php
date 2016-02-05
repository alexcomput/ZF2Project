<?php

namespace Produto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Produto\Form\Produto as FormProduto;

class ProdutoController extends AbstractActionController
{

    public function indexAction()
    {
        $request = $this->getRequest();
//        $result = array();
        $form = new FormProduto();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                //$produto->setDescricao($request->getPost("produto"));

                $service = $this->getServiceLocator()->get("Produto\Service\Produto");
                if ($service->insert($request->getPost()->toArray())) {
                    $fm = $this->flashMessenger()
                            ->setNamespace('Produto')
                            ->addMessage("Produto Caastradocom sucesso.");
                }
            }
            return $this->redirect()->toRoute('home-produto');
            //$produto = new \Produto\Entity\Produto();
            //$service = $this->getServiceLocator()->get("SONUser\Service\User");
//            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
//            $em->persist($produto);
//            $em->flush(); 
//            }
            //$result["resp"] = $produto->getDescricao() . ", enviado corretamente!";
        }
        $messages = $this->flashMessenger()->setNamespace('Produto')->getMessages();
        return new ViewModel(array('form' => $form, 'messages' => $messages));
//        return new ViewModel($result);
//
//        return new ViewModel(array('form' => $form, 'messages' => $messages));
    }

}
