<?php

namespace SONUser\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use SONUser\Form\User as FormUser;

class IndexController extends AbstractActionController
{

//    public function registerAction()
//    {
//        $form = new FormUser;
//        $request = $this->getRequest();
//        if ($request->isPost()) {
//            $form->setData($request->getPost());
//            if ($form->isValid()) {
//                $service = $this->getServiceLocator()->get('SONUser\Service\User');
//                if ($service->insert($request->getPost()->toArray())) {
//                    $fm = $this->flashMessenger()
//                            ->setNamespace('SONUser')
//                            ->addMessage('Usuário cadastrado com Sucesso');
//                }
//                return $this->redirect()->toRoute('sonuser-register');
//            }
//        }
//        $messages = $this->flashMessenger()
//                ->setNamespace('SONUser')
//                ->getMessages();
//        return new ViewModel(array('form' => $form, 'messages' => $messages));
//    }

    public function registerAction()
    {
        $request = $this->getRequest();
        $result = array();
        try {
            if ($request->isPost()) {
                $nome = $request->getPost("nome");
                $cpf = $request->getPost("cpf");
                $email = $request->getPost("email");
                $password = $request->getPost("password");
                //$salario = $request->getPost("salario");

                $user = new \SONUser\Entity\User();
                $user->setEmail($email);
                $user->setNome($nome);
                $user->setPassword($password);
                //$user->setSalt($cpf);

                $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                $em->persist($user);
                $em->flush();

                $result["resp"] = $user->getNome() . ", enviado corretamente! ";
            }
        } catch (Exception $e) {
            echo "Erro $e";
        }
        return new ViewModel($result);

// return new ViewModel();
    }

    public function listarAction()
    {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $lista = $em->getRepository("SONUser\Entity\User")->findAll();
        return new ViewModel(array('lista' => $lista));
    }

}
