<?php
    echo  '<div id="inicioJefatura" style="style:top: 30%;left:10%;"></div>';
    echo  use_helper('Javascript');
    echo  javascript_tag("
      Saspa.inicio  = new Ext.Panel({
          renderTo: 'inicioJefatura',
          layout: 'fit',
          frame: true,
          items:  [
              {
                xtype:  'label',
                text:   'BIENVENIDO A SASPA',
                frame:  true,
                border: false
              }
          ]
      });
      Saspa.inicio.render();
    ");
?>