<?php

namespace Produto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProdutoController extends AbstractActionController
{
    public function indexAction() 
    {
        return new ViewModel([
            'nome' => 'alex'
        ]);
    }
}
