<?php

namespace Produto\Form;

use Zend\Form\Form;

class Produto extends Form
{

    function __construct($name = null, $options = array())
    {
        parent::__construct('produto', $options);
        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $nome = new \Zend\Form\Element\Text('nome');
        $nome->setLabel('Nome:')
                ->setAttribute('placeholder', 'Entre com o Nome');
        $this->add($nome);

        $this->add(array(
            'name' => 'Submit',
            'type' => '\Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn-success'
            )
        ));
    }

}
