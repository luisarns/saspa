<?php
    echo  '<div id="inicioDaca" style="style:top: 30%;left:10%;"></div>';
    echo  use_helper('Javascript');
    echo  javascript_tag("
      Saspa.inicio  = new Ext.Panel({
          renderTo: 'inicioDaca',
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