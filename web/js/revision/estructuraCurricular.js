Ext.namespace('Saspa.analisis');

//Aqui construyo el grid
Saspa.analisis.estEstCurr = new Ext.data.SimpleStore({
   fields     : [
     {name :'id', type : 'int'},
     {name :'sol_id', type : 'int'}, 
     {name :'periodo', type : 'int'},
     {name :'asignatura'},
     {name :'num_creditos', type : 'int'},
     {name :'total_horas', type : 'int'},
     {name :'num_programa_comparte', type : 'int'},
     {name :'categoria_docente'},
     {name :'horas_dictadas_como'},
     {name :'valor_hora', type : 'float'},
   ]
 });

Saspa.analisis.cm_extruCurri = new Ext.grid.ColumnModel([
   {header : 'Periodo', tooltip : 'Periodo Academico', width : 60, sortable : true , dataIndex : 'periodo' },
   {id : 'asignatura', header : 'Asignatura', sortable : true , dataIndex : 'asignatura' },
   {header : 'Creditos', width : 60, sortable : true , dataIndex : 'num_creditos' },
   {header : 'Total horas', tooltip : 'Total horas en el  periodo academico', width : 72, sortable : true , dataIndex : 'total_horas' },
   {header : 'Programas que comparte', tooltip : 'Numero de programas que comparten la asignatura',width : 132, sortable : true , dataIndex : 'num_programa_comparte' },
   {header : 'Categoria docente', tooltip : 'Categoria del docente' ,width : 110, sortable : true, dataIndex : 'categoria_docente'},
   {header : 'Horas dictadas como', width : 120, sortable : true, dataIndex : 'horas_dictadas_como'},
   {header : 'Valor hora', width : 100, sortable : true, dataIndex : 'valor_hora'}
 ]);
 
 
 //Grid con el contenido de la estructura curricular de la solicitud
Saspa.analisis.grdStrCrrc = new Ext.grid.GridPanel({
   store      : Saspa.analisis.estEstCurr,
   cm         : Saspa.analisis.cm_extruCurri,
   viewConfig : {
       forceFit : true
   },
   sm      : new Ext.grid.RowSelectionModel({singleSelect:true}),
   width   : 600,
   height  : 300,
   frame   : true,
   title   :'Estructura Curricular',
   iconCls :'icon-grid'
 });

 
 
 /*
 * Cargar asignaturas.
 * carga los registro de las asignaturas en el store
 * @arr array : matriz bidimensional con una fila por cada registro BD
 * de las asignaturas que estan en la estructura curricular de la solicitud
 * en revision. 
 */
 Saspa.analisis.crgSgn = function(arr)
 {
   Saspa.analisis.estEstCurr.loadData(arr);
 }
