<?php

use App\User;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


// USUARIOS LOGUEADOS
Route::group(['middleware' => 'auth'], function () {

	Route::get('/', 'HomeController@index');
	Route::get('/home', function () {
		return redirect('/');
	});

	//User
	Route::post('/user/foto', 'UserController@saveFoto');
	//Ubigeo
	Route::get('/provincias/{iddepartamento}', 'SisfohController@getProvincias');
	Route::get('/distritos/{idprovincia}', 'SisfohController@getDistritos');
	//IE
	Route::get('/colegios/{idubigeo}', 'InstitucionEducativaController@getColegiosUbigeo');
	//Sisfoh
	Route::get('/sisfoh', 'SisfohController@index');
	Route::post('/sisfoh/save1', 'SisfohController@saveStep1');
	Route::post('/sisfoh/save2', 'SisfohController@saveStep2');
	Route::post('/sisfoh/save3', 'SisfohController@saveStep3');
	Route::post('/sisfoh/save4', 'SisfohController@saveStep4');
	//Poblacion
	Route::get('/poblacion/all', 'PoblacionController@getPoblacion');
	Route::get('/poblacion/{idpersona}', 'PoblacionController@getPersona');
	Route::post('/poblacion/save', 'PoblacionController@savePersona');
	Route::post('/poblacion/delete', 'PoblacionController@deletePersona');
	//Cargar Resultados
	Route::get('cargar-resultados', 'PostulacionController@cargarResultados')->middleware('asistente');
	Route::post('cargar-resultados', 'PostulacionController@cargarResultadosExcel')->middleware('asistente');
	//Cargar Pagos
	Route::get('cargar-pagos', 'PagosController@cargarPagos');
	Route::post('cargar-pagos', 'PagosController@cargarPagosExcel');
	//AGREGO 11/10/2018
	//Cargar Preguntas
	Route::get('cargar-preguntas', 'PreguntasController@cargarPreguntas');
	Route::post('cargar-preguntas', 'PreguntasController@cargarPreguntasExcel');

	//AGREGO 19/10/2018
	//Preguntas usadas
	Route::get('/mantenimiento/preguntas-usadas', 'PreguntasController@indexUsadas');
	Route::post('/mantenimiento/listaPreguntas-usadas', 'PreguntasController@listaPreguntasUsadas');
	Route::post('/mantenimiento/actualizarPreguntas-usadas', 'PreguntasController@actualizarPreguntasUsadas');





	Route::post('grabarPago', 'PagosController@grabarPago');
	Route::get('grabarPago', 'PagosController@grabarPago');
	//	Route::post('cargar-txt', 'TxtController@cargarInformacionExcel');
	// Postulación
	Route::get('/postular', 'PostulacionController@index')->middleware('postulante');
	Route::post('/postular/save', 'PostulacionController@saveStep');
	Route::get('/verificarpostulacion', 'PostulacionController@indexverificar')->middleware('asistente');
	Route::post('getpostulacion', 'PostulacionController@getPostulacion');
	Route::post('verificar', 'PostulacionController@verificar')->middleware('asistente');
	Route::post('editar', 'PostulacionController@editar')->middleware('coordinador');
	// Cambio de contraseña
	Route::post('/user/changepassword', 'UserController@changepassword');
	// Pagos informacion
	Route::get('cargar-informacion', 'PagosController@pagosInformacion');
	//Finalizar la postulacion
	Route::get('/finalizar', 'PostulacionController@finalizarPostulacion')->middleware('postulante');
	// Reportes
	Route::get('rep-postulantes', 'ReporteController@postulantes')->middleware('asistente');
	Route::post('rep-postulantes-list', 'ReporteController@listPostulates')->middleware('asistente');
	Route::post('cargarfiltro', 'ReporteController@cargaFiltro')->middleware('asistente');
	Route::get('rep-estadisticas', 'ReporteController@estadistica')->middleware('asistente');
	Route::post('rep-estadisticas-list', 'ReporteController@listaEstadistica')->middleware('asistente');
	Route::get('rep-pagos', 'ReporteController@pagos')->middleware('asistente');
	Route::post('rep-pagos-list', 'ReporteController@listaPagos')->middleware('asistente');
	Route::get('/rep-constancias', 'ReporteController@constancias')->middleware('asistente');
	Route::post('/rep-constancias-list', 'ReporteController@listaConstancias')->middleware('asistente');
	Route::get('rep-pagossubidos', 'ReporteController@pagossubidos')->middleware('asistente');
	Route::post('/rep-pagossubidos-list', 'ReporteController@listaPagosSubidos')->middleware('asistente');


	//ALUMNOS + AULA


	Route::get('/rep-alumaula', 'ReporteController@repalumaula')->middleware('asistente');
	Route::post('rep-postulantes-list-aula', 'ReporteController@listPostulatesaulas')->middleware('asistente');


	//Padron
	Route::get('/rep-padron', 'ReporteController@padron')->middleware('asistente');
	Route::post('/rep-padron-list', 'ReporteController@listaPadron')->middleware('asistente');
	Route::get('/rep-padron-postulantes', 'ReporteController@padronpostulantes')->middleware('asistente');
	Route::post('/rep-padron-list-postulantes', 'ReporteController@listaPadronPostulantes')->middleware('asistente');
	//Estadistica
	//AGREGADO 20/09/2018
	Route::get('/rep-estadisticas-post-edad', 'ReporteController@estadisticaEdad')->middleware('asistente');
	Route::post('/rep-estadisticas-list-post-edad', 'ReporteController@listaEstadisticaEdad')->middleware('asistente');
	Route::get('/rep-estadisticas-ing-edad', 'ReporteController@estadisticaEdadIngresante')->middleware('asistente');
	Route::post('/rep-estadisticas-list-ing-edad', 'ReporteController@listaEstadisticaEdadIngresante')->middleware('asistente');

	//Calificacion
	Route::get('rep-calificacion', 'TxtController@postulantes')->middleware('asistente');
	Route::post('rep-constancias-cali', 'TxtController@listPostulates')->middleware('asistente');
	Route::get('rep-calificacion-cepre', 'TxtController@postulantesCepre')->middleware('asistente');
	Route::post('rep-constancias-cali-cepre', 'TxtController@listPostulatesCepre')->middleware('asistente');
	Route::get('rep-calificacion-simulacro', 'TxtController@postulantesSimulacro')->middleware('asistente');
	Route::post('rep-constancias-cali-simulacro', 'TxtController@listPostulatesSimulacro')->middleware('asistente');

	//CALIFICACION - 2020

	Route::get('rep-calificacion-2020-2', 'TxtController@postulantes2020II')->middleware('asistente');
	Route::post('rep-constancias-cali-2020-2', 'TxtController@listPostulates2020II')->middleware('asistente');

	Route::get('rep-calificacion-2020-2_canal_A', 'TxtController@postulantes2020II_canal_A')->middleware('asistente');
	Route::post('rep-constancias-cali-2020-2_canal_A', 'TxtController@listPostulates2020II_canal_A')->middleware('asistente');

	Route::get('rep-calificacion-2020-2_canal_B', 'TxtController@postulantes2020II_canal_B')->middleware('asistente');
	Route::post('rep-constancias-cali-2020-2_canal_B', 'TxtController@listPostulates2020II_canal_B')->middleware('asistente');

	Route::get('rep-calificacion-2020-2_canal_C', 'TxtController@postulantes2020II_canal_C')->middleware('asistente');
	Route::post('rep-constancias-cali-2020-2_canal_C', 'TxtController@listPostulates2020II_canal_C')->middleware('asistente');

	Route::get('rep-calificacion-2020-2_canal_D', 'TxtController@postulantes2020II_canal_D')->middleware('asistente');
	Route::post('rep-constancias-cali-2020-2_canal_D', 'TxtController@listPostulates2020II_canal_D')->middleware('asistente');

	//AGREGI 23/10/2018
	Route::get('rep-calificacion-cepre-II', 'TxtController@postulantesCepreII')->middleware('asistente');
	Route::post('rep-constancias-cali-cepre-II', 'TxtController@listPostulatesCepreII')->middleware('asistente');

	//AGREGO 27/09/2018 DUPLICADO CALIFICACION - CEPRE
	Route::get('rep-calificacion-cepre-duplicados', 'TxtController@postulantesCepreDuplicados')->middleware('asistente');
	Route::post('rep-constancias-cali-cepre-duplicados', 'TxtController@listPostulatesCepreDuplicados')->middleware('asistente');
	//AGREGO 30/09/2018
	Route::get('rep-calificacion-cepre-canales', 'TxtController@postulantesCepreCanales')->middleware('asistente');
	Route::post('rep-constancias-cali-cepre-canales', 'TxtController@listPostulatesCepreCanales')->middleware('asistente');

	//AGREGO 11/10/2018
	Route::get('rep-calificacion-simulacro-duplicados', 'TxtController@postulantesSimulacroDuplicados')->middleware('asistente');
	Route::post('rep-constancias-cali-simulacro-duplicados', 'TxtController@listPostulatesSimulacroDuplicados')->middleware('asistente');

	//AGREGO 11/10/2018
	Route::get('rep-calificacion-simulacro-canales', 'TxtController@postulantesSimulacroCanales')->middleware('asistente');
	Route::post('rep-constancias-cali-simulacro-canales', 'TxtController@listPostulatesSimulacroCanales')->middleware('asistente');

	//AGREGO 18/10/2018
	Route::get('rep-calificacion-cepre-final', 'TxtController@postulantesCepreFinal')->middleware('asistente');
	Route::post('rep-constancias-cali-cepre-final', 'TxtController@listPostulatesCepreFinal')->middleware('asistente');

	//AGREGO 22/10/2018
	Route::get('rep-calificacion-cepre-duplicados-II', 'TxtController@postulantesCepreDuplicadosII')->middleware('asistente');
	Route::post('rep-constancias-cali-cepre-duplicados-II', 'TxtController@listPostulatesCepreDuplicadosII')->middleware('asistente');
	//AGREGO 22/10/2018
	Route::get('rep-calificacion-cepre-canales-II', 'TxtController@postulantesCepreCanalesII')->middleware('asistente');
	Route::post('rep-constancias-cali-cepre-canales-II', 'TxtController@listPostulatesCepreCanalesII')->middleware('asistente');

	//AGREGO 17/10/2018
	Route::get('rep-calificacion-canales', 'TxtController@postulantesCanales')->middleware('asistente');
	Route::post('rep-constancias-cali-canales', 'TxtController@listPostulatesCanales')->middleware('asistente');

	//AGREGO 25/10/2018
	Route::get('rep-calificacion-duplicados', 'TxtController@postulantesDuplicados')->middleware('asistente');
	Route::post('rep-constancias-cali-duplicados', 'TxtController@listPostulatesDuplicados')->middleware('asistente');

	//AGREGO DUPLICADOS 2020-2
	Route::get('rep-calificacion-duplicados-2020-2', 'TxtController@postulantesDuplicados2020II')->middleware('asistente');
	Route::post('rep-constancias-cali-duplicados-2020-2', 'TxtController@listPostulatesDuplicados2020II')->middleware('asistente');

	//AGREGO 17/11/2018
	Route::get('rep-calificacion-canales-HR', 'TxtController@postulantesCanalesHR')->middleware('asistente');
	Route::post('rep-constancias-cali-canales-HR', 'TxtController@listPostulatesCanalesHR')->middleware('asistente');

	//AGREGO 15/02/2019
	Route::get('rep-calificacion-cepre-canales-HI', 'TxtController@postulantesCepreCanalesHI')->middleware('asistente');
	Route::post('rep-constancias-cali-cepre-canales-HI', 'TxtController@listPostulatesCepreCanalesHI')->middleware('asistente');

	//AGREGO 14/02/2019
	Route::get('rep-calificacion-cepre-canales-HR', 'TxtController@postulantesCepreCanalesHR')->middleware('asistente');
	Route::post('rep-constancias-cali-cepre-canales-HR', 'TxtController@listPostulatesCepreCanalesHR')->middleware('asistente');

	//AGREGO 20/02/2019
	Route::get('rep-calificacion-cepre-canales-HI-2', 'TxtController@postulantesCepreCanalesHI_2')->middleware('asistente');
	Route::post('rep-constancias-cali-cepre-canales-HI-2', 'TxtController@listPostulatesCepreCanalesHI_2')->middleware('asistente');

	//AGREGO 02/02/2019
	Route::get('rep-calificacion-cepre-canales-HR-2', 'TxtController@postulantesCepreCanalesHR_2')->middleware('asistente');
	Route::post('rep-constancias-cali-cepre-canales-HR-2', 'TxtController@listPostulatesCepreCanalesHR_2')->middleware('asistente');

	//AGREGO 20/03/2019
	Route::get('rep-calificacion-simulacro-canales-HI', 'TxtController@postulantesSimulacroCanalesHI')->middleware('asistente');
	Route::post('rep-constancias-cali-simulacro-canales-HI', 'TxtController@listPostulatesSimulacroCanalesHI')->middleware('asistente');

	//AGREGO 20/03/2019
	Route::get('rep-calificacion-simulacro-canales-HR', 'TxtController@postulantesSimulacroCanalesHR')->middleware('asistente');
	Route::post('rep-constancias-cali-simulacro-canales-HR', 'TxtController@listPostulatesSimulacroCanalesHR')->middleware('asistente');

	//REPORTE DE CALIFICACION POR POSTULANTE 08/11/2019 HR
	Route::get('rep-calificacion-por-postulante', 'TxtController@ReporteCalificacionPorPostulante')->middleware('asistente');
	Route::post('rep-lista-calificacion-por-postulante', 'TxtController@listarReporteCalificacionPorPostulante')->middleware('asistente');

	Route::get('rep-calificacion-por-postulante-2020-2', 'TxtController@ReporteCalificacionPorPostulante2020II')->middleware('asistente');
	Route::post('rep-lista-calificacion-por-postulante-2020-2', 'TxtController@listarReporteCalificacionPorPostulante2020II')->middleware('asistente');


	Route::get('rep-calificacion-por-postulante-cepre', 'TxtController@ReporteCalificacionPorPostulanteCepre')->middleware('asistente');
	Route::post('rep-lista-calificacion-por-postulante-cepre', 'TxtController@listarReporteCalificacionPorPostulanteCepre')->middleware('asistente');
	Route::get('rep-calificacion-por-postulante-cepre-2', 'TxtController@ReporteCalificacionPorPostulanteCepre2')->middleware('asistente');
	Route::post('rep-lista-calificacion-por-postulante-cepre-2', 'TxtController@listarReporteCalificacionPorPostulanteCepre2')->middleware('asistente');

	//Cargar Txt
	Route::get('cargar-txt-2020-2', 'TxtController@cargarInformacion20202');
	Route::post('cargar-txt-2020-2', 'TxtController@cargarInformacionTXT20202');
	Route::post('cargar-txt1-2020-2', 'TxtController@cargarInformacionTXT120202');
	Route::post('cargar-txt2-2020-2', 'TxtController@cargarInformacionTXT220202');
	Route::post('cargar-txt3-2020-2', 'TxtController@cargarInformacionTXT320202');
	Route::get('cargar-txt', 'TxtController@cargarInformacion');
	Route::post('cargar-txt', 'TxtController@cargarInformacionTXT');
	Route::post('cargar-txt1', 'TxtController@cargarInformacionTXT1');
	Route::post('cargar-txt2', 'TxtController@cargarInformacionTXT2');
	Route::post('cargar-txt3', 'TxtController@cargarInformacionTXT3');
	Route::get('cargar-txt-cepre', 'TxtController@cargarInformacionCepre');
	Route::post('cargar-txt-cepre', 'TxtController@cargarInformacionTXTCepre');
	Route::post('cargar-txt-cepre1', 'TxtController@cargarInformacionTXTCepre1');
	Route::post('cargar-txt-cepre2', 'TxtController@cargarInformacionTXTCepre2');
	Route::post('cargar-txt-cepre3', 'TxtController@cargarInformacionTXTCepre3');

	//AGREGADO 19/10/2018
	Route::get('cargar-txt-cepre-2', 'TxtController@cargarInformacionCepre2');
	Route::post('cargar-txt-cepre-2', 'TxtController@cargarInformacionTXTCepreII');
	Route::post('cargar-txt-cepre1-2', 'TxtController@cargarInformacionTXTCepre1II');
	Route::post('cargar-txt-cepre2-2', 'TxtController@cargarInformacionTXTCepre2II');
	Route::post('cargar-txt-cepre3-2', 'TxtController@cargarInformacionTXTCepre3II');


	Route::get('cargar-txt-simulacro', 'TxtController@cargarInformacionSimulacro');
	Route::post('cargar-txt-simulacro', 'TxtController@cargarInformacionTXTSimulacro');
	Route::post('cargar-txt-simulacro1', 'TxtController@cargarInformacionTXTSimulacro1');
	Route::post('cargar-txt-simulacro2', 'TxtController@cargarInformacionTXTSimulacro2');
	Route::post('cargar-txt-simulacro3', 'TxtController@cargarInformacionTXTSimulacro3');

	Route::get('llenar-identificacion', 'TxtController@procesoIdentifacion');
	Route::get('llenar-respuestas', 'TxtController@procesoRespuesta');
	Route::get('llenar-respuestas-cepre', 'TxtController@procesoRespuestaCepre');
	//respuesta 2020

	Route::get('llenar-respuestas-2020-2', 'TxtController@procesoRespuesta2020II');

	Route::get('llenar-respuestas-2020-2_canal_A', 'TxtController@procesoRespuesta2020II_canal_A');

	Route::get('llenar-respuestas-2020-2_canal_B', 'TxtController@procesoRespuesta2020II_canal_B');

	Route::get('llenar-respuestas-2020-2_canal_C', 'TxtController@procesoRespuesta2020II_canal_C');

	Route::get('llenar-respuestas-2020-2_canal_D', 'TxtController@procesoRespuesta2020II_canal_D');


	//AGREGADO 23/10/2018
	Route::get('llenar-respuestas-cepre-II', 'TxtController@procesoRespuestaCepreII');
	Route::get('llenar-respuestas-simulacro', 'TxtController@procesoRespuestaSimulacro');
	Route::get('llenar-claves', 'TxtController@procesoClavesSolucionario');

	//Reporte lista ingresantes
	Route::get('rep-listaIngresantes', 'ReporteController@ingresantes')->middleware('coordinador');
	Route::post('rep-ingresante-list', 'ReporteController@listaIngresantes')->middleware('coordinador');
	//Reporte de postulantes validos y no validos
	Route::get('rep-postulantesvalidosnovalidos', 'ReporteController@postulantesvalidadonovalidado')->middleware('coordinador');
	Route::post('rep-postulantesvalidado-list', 'ReporteController@listvalnoval')->middleware('coordinador');
	// PDF
	Route::get('/pdf/ficha_inscripcion/{id?}', 'PDFController@fichaInscripcion');
	Route::get('/pdf/carne_inscripcion/{id?}', 'PDFController@carneInscripcion');
	Route::get('/pdf/jdantecedentes_inscripcion/{id?}', 'PDFController@djantecedentesInscripcion');
	Route::get('/pdf/constancias/{idproceso}/{idescuela}', 'PDFController@constancias')->middleware('asistente');
	//padron
	Route::get('/pdf/padron/{idproceso}/{idescuela}', 'PDFController@padron')->middleware('asistente');
	Route::get('/pdf/reportecalificacioncepre', 'PDFController@calificacioncepre')->middleware('asistente');
	Route::get('/pdf/padronpostulantes/{idproceso}/{idambiente}', 'PDFController@padronpostulantes')->middleware('asistente');

	Route::get('generar-pdf-reporte', 'PDFController@calificacionsimulacroregional')->middleware('asistente');

	Route::post('enviar2', 'PostulacionController@SubirArchivo');

	Route::get('/pdf/calificacionsimulacro', 'PDFController@calificacionsimulacro');

	Route::get('sendemail', function () {
		$data = array(
			'name' => "Curso Laravel",
		);
		Mail::send('welcome', $data, function ($message) {
			$message->from('nemesisalex96@gmail.com', 'Curso Laravel');
			$message->to('nemesisalex96@gmail.com')->subject('test email Curso 	Laravel');
		});
		return "Tu email ha sido enviado correctamente";
	});


	//GENERACION DE EXAMENES DE ADMISION (PREGUNTAS ALEATORIAS)
	Route::get('generarexa/lista', 'GenerarexaController@lista')->middleware('coordinador');
	Route::get('generarexa/index/{token}', 'GenerarexaController@index')->middleware('coordinador');
	Route::get('getpreguntas', 'GenerarexaController@getPreguntas');


	Route::get('comboMateria', 'GenerarexaController@cargarMateria');
	Route::post('comboMateria', 'GenerarexaController@cargarMateria');

	Route::get('comboDificultad', 'GenerarexaController@cargarDificultad');
	Route::post('comboDificultad', 'GenerarexaController@cargarDificultad');

	Route::get('obtenerPregunta', 'GenerarexaController@obtenerPregunta');
	Route::post('obtenerPregunta', 'GenerarexaController@obtenerPregunta');




	Route::post('actualizarEstado', 'GenerarexaController@actualizarEstado');
	Route::get('actualizarEstado', 'GenerarexaController@actualizarEstado');

	Route::post('grabarDetalle', 'GenerarexaController@grabarDetalle');
	Route::get('grabarDetalle', 'GenerarexaController@grabarDetalle');

	Route::post('grabarDetallerep', 'GenerarexaController@grabarDetallerep');
	Route::get('grabarDetallerep', 'GenerarexaController@grabarDetallerep');

	Route::post('convertir', 'GenerarexaController@convertir');
	Route::get('convertir', 'GenerarexaController@convertir');



	Route::post('grabarEvaluacion', 'GenerarexaController@grabarEvaluacion');
	Route::get('grabarEvaluacion', 'GenerarexaController@grabarEvaluacion');


	Route::get('nextstep', 'GenerarexaController@nextstep');
	Route::post('nextstep', 'GenerarexaController@nextstep');


	Route::get('nextsteptwo', 'GenerarexaController@nextsteptwo');
	Route::post('nextsteptwo', 'GenerarexaController@nextsteptwo');


	Route::get('examenAdmision/{idevaluacion}', 'PDFController@examenAdmision')->middleware('coordinador');
	Route::get('examenAdmisionTONE/{idevaluacion}', 'PDFController@examenAdmisionTONE')->middleware('coordinador');
	Route::get('examenAdmisionTTREE/{idevaluacion}/{idproceso}', 'PDFController@examenAdmisionTTREE')->middleware('coordinador');
	Route::get('examenAdmisionTTWO/{idevaluacion}/{idproceso}', 'PDFController@examenAdmisionTTWO')->middleware('coordinador');
	Route::get('examenAdmisionTFOUR/{idevaluacion}', 'PDFController@examenAdmisionTFOUR')->middleware('coordinador');


	Route::get('getMateriasExamen', 'PDFController@getMateriasExamen');
	Route::post('getMateriasExamen', 'PDFController@getMateriasExamen');



	Route::post('listaevaluaciones', 'GenerarexaController@listaevaluaciones');

	//AGREGADO 09102018
	Route::post('actualizarDuplicado', 'TxtController@actualizarDuplicado');
	Route::post('actualizarCanal', 'TxtController@actualizarCanal');

	//AGREGADI 22102018
	Route::post('actualizarDuplicadoII', 'TxtController@actualizarDuplicadoII');
	Route::post('actualizarCanalII', 'TxtController@actualizarCanalII');

	//AGREGADO 11102018
	Route::post('actualizarSimulacroDuplicado', 'TxtController@actualizarSimulacroDuplicado');
	Route::post('actualizarSimulacroCanal', 'TxtController@actualizarSimulacroCanal');

	//AGREGADO 17112018
	Route::post('actualizarAdmisionDuplicado', 'TxtController@actualizarAdmisionDuplicado');
	Route::post('actualizarAdmisionCanal', 'TxtController@actualizarAdmisionCanal');

	Route::get('hola', 'TxtController@holaErick');

	//ACTUALIZACION DUPLICADOS 2020_2
	Route::post('actualizarAdmisionDuplicado-2020-2', 'TxtController@actualizarAdmisionDuplicado2020II');
	Route::post('actualizarAdmisionCanal-2020-2', 'TxtController@actualizarAdmisionCanal2020II');

	//Route::post('ROUTE', 'NAME OF CONTROLLER@NAME OF FUNCTION');

	//AGREGADO 17112018
	Route::post('actualizarAdmisionCanalHR', 'TxtController@actualizarAdmisionCanalHR');

	//AGREGADO 16/02/2019
	Route::post('actualizarCepreCanalHR', 'TxtController@actualizarCepreCanalHR');

	//AGREGADO 16022019
	Route::post('actualizarCepreCanalHI', 'TxtController@actualizarCepreCanalHI');

	//AGREGADO 16/02/2019
	Route::post('actualizarCepreCanalHR_2', 'TxtController@actualizarCepreCanalHR_2');

	//AGREGADO 16022019
	Route::post('actualizarCepreCanalHI_2', 'TxtController@actualizarCepreCanalHI_2');

	//AGREGADO 20/03/2019
	Route::post('actualizarSimulacroCanalHR', 'TxtController@actualizarSimulacroCanalHR');

	//AGREGADO 20/03/2019    
	Route::post('actualizarSimulacroCanalHI', 'TxtController@actualizarSimulacroCanalHI');


	// Enviar Documentos
	//	Route::get('enviar-documentos', 'PostulacionController@EnviarCorreo');
	//Route::get('enviar', 'PostulacionController@Enviar');
	Route::post('enviar-documentos', 'PostulacionController@EnviarCorreo');

	// USUARIOS POSTULANTE
	Route::group(['middleware' => 'postulante'], function () {
	});

	// USUARIOS ADMINISTRADOR
	Route::group(['middleware' => 'administrador'], function () {
	});

	// USUARIOS COORDINADOR
	Route::group(['middleware' => 'coordinador'], function () {
		//AGREGO 11/10/2018
		//Materias
		Route::get('/mantenimiento/materia', 'MateriaController@index');
		Route::post('/mantenimiento/listaMaterias', 'MateriaController@listaMaterias');
		Route::post('/mantenimiento/crearMaterias', 'MateriaController@crearMaterias');
		Route::post('/mantenimiento/actualizarMaterias', 'MateriaController@actualizarMaterias');
		Route::post('/mantenimiento/eliminarMaterias', 'MateriaController@eliminarMaterias');

		//Preguntas
		Route::get('/mantenimiento/preguntas', 'PreguntasController@index');
		Route::post('/mantenimiento/listaPreguntas', 'PreguntasController@listaPreguntas');
		Route::post('/mantenimiento/crearPreguntas', 'PreguntasController@crearPreguntas');
		Route::post('/mantenimiento/actualizarPreguntas', 'PreguntasController@actualizarPreguntas');
		Route::post('/mantenimiento/eliminarPreguntas', 'PreguntasController@eliminarPreguntas');
		Route::post('/mantenimiento/cargarfiltro', 'ReporteController@cargaFiltro');

		//REGISTRO DE POSTULANTES SIMULACRO
		Route::get('/configuracion/postulanteSimulacro', 'CT_ADM005@index');
		Route::post('/configuracion/listaPostulanteSimulacro', 'CT_ADM005@listaPostulanteSimulacro');
		Route::post('/configuracion/crearPostulanteSimulacro', 'CT_ADM005@crearPostulanteSimulacro');
		Route::post('/configuracion/actualizarPostulanteSimulacro', 'CT_ADM005@actualizarPostulanteSimulacro');
		Route::post('/configuracion/eliminarPostulanteSimulacro', 'CT_ADM005@eliminarPostulanteSimulacro');

		//Proceso
		Route::get('/mantenimiento/proceso', 'ProcesoController@index');
		Route::get('/mantenimiento/usuarios', 'UsuariosController@index');

		Route::post('/mantenimiento/listausuarios', 'UsuariosController@listausuariosPorRol');
		Route::post('usuarios', 'UsuariosController@listarusuario');
		Route::post('/mantenimiento/buscarUsuario', 'UsuariosController@indexEditar');
		Route::post('actualizarU', 'UsuariosController@usuarios');
		Route::post('/mantenimiento/lista', 'ProcesoController@lista');
		Route::post('/mantenimiento/create', 'ProcesoController@create');
		Route::post('/mantenimiento/terminar', 'ProcesoController@terminarProceso');
		Route::post('/mantenimiento/editresolucion', 'ProcesoController@editarResolucion');
		Route::get('/mantenimiento/aulasPorExamen', 'AulasPorExamen@index');
		Route::post('/mantenimiento/listaAulas', 'AulasPorExamen@listaAulasTipoExamen');
		Route::post('/mantenimiento/crearaulas', 'AulasPorExamen@guardarAula');
		Route::post('/mantenimiento/crearaulas1', 'AulasPorExamen@guardarAula1');
		Route::post('/mantenimiento/{id}', 'AulasPorExamen@borradologico');
		Route::post('/mantenimiento/edit', 'AulasPorExamen@actualizar');



		Route::get('/mantenimiento/tarifa', 'TarifaModalidad@index');
		Route::post('listaTarifas', 'TarifaModalidad@listaTarifaModalidad');

		Route::get('form_enviar_correo', 'CorreoController@crear');
		Route::post('enviar', 'CorreoController@enviar');
	});

	// USUARIOS ASISTENTE
	Route::group(['middleware' => 'asistente'], function () {
	});

	// USUARIOS DOCENTE
	Route::group(['middleware' => 'docente'], function () {
	});
	// USUARIOS ALUMNO
	Route::group(['middleware' => 'alumno'], function () {
	});
});

/* Ruta para asignar ambiente de evaluación ingresando el idpostulante
use App\Postulacion;
use App\Tarifa;
use App\Escuela;
use App\Ambiente;
use App\Modalidad;
Route::get('asignaaula/{id}', function($idpostulante)
{
	$postulacion = Postulacion::find($idpostulante);
  // Asignacion de ambiente para evaluacion sólo a examen general
    $tarifa = Tarifa::find($postulacion->idtarifa);
    if(Modalidad::find($tarifa->idmodalidad)->id == 1){
        $escuela = Escuela::find($postulacion->idescuela);
        $ambientes = Ambiente::where('idarea', $escuela->idarea)->get();
        foreach ($ambientes as $ambiente) {
            $cantidadOcupado = Postulacion::where('idescuela', $ambiente->id)->count();
            if($ambiente->capacidad > $cantidadOcupado){
                $postulacion->idambiente = $ambiente->id;
                break;
            }
        }
    }
    $postulacion->save();
});
*/