<?php
    
class SolicitudesController extends CController
{
    public function actions()
    {
        return array(
            'nueva'=>array(
                'class'=>'CWebServiceAction',
            ),
        );
    }
 

       
    /**
     * @param string 
     * @param string 
     * @param string 
     * @param string 
     * @param string 
     * @param string 
     * @return string
     * @soap
     */
    public function create($fecha,$usuario_id,$codigo,$estado,$tipo,$proveedor)
    {
        $solicitud = new SolicitudCompra();
        $solicitud->fecha_alta = $fecha;
        $solicitud->usuario_solicitante = $usuario_id;
        $solicitud->codigo_solicitud = $codigo;
        $solicitud->estado = $estado;
        $solicitud->tipo_compra_id= $tipo;
        $solicitud->proveedor_id = $proveedor;
        $solicitud->save();  
        
        return("solicitud creada");
    }
    
    
    
}


?>