<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class FichaSocioeconomica extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ficha_socioeconomica';

    public function __construct ($attributes = array())
    {
        parent::__construct($attributes); // Calls Default Constructor
        $this->id = 0;
        $this->idubigeo = 0;
    }

    public static function listasCombo(){
    	return array(	1=> ['lista' => FichaSocioeconomica::listaTipoVivienda(), 
							'titulo' => '1.Tipo de Vivienda', 
							'idselect' => 'selectTipoVivienda',
							'idtext' => 'txtTipoVivienda',
                            'name' => 'tipovivienda'],
    					2=> ['lista' => FichaSocioeconomica::listaSuViviendaEs(),
    						'titulo' => '2.Su vivienda es:', 
							'idselect' => 'selectSuViviendaEs', 
							'idtext' => 'txtSuViviendaEs',
                            'name' => 'suviviendaes'],
    					3=> ['lista' => FichaSocioeconomica::listaMaterialParedes(),
    						'titulo' => '3.El material de las paredes exteriores es:', 
							'idselect' => 'selectMaterialPredominantePared', 
							'idtext' => 'txtMaterialPredominantePared',
                            'name' => 'materialparedes'],
    					4=> ['lista' => FichaSocioeconomica::listaMaterialTecho(),
    						'titulo' => '4.El material predominante en los techos es:', 
							'idselect' => 'selectMaterialPredominanteTecho', 
							'idtext' => 'txtMaterialPredominanteTecho',
                            'name' => 'materialtecho'],
    					5=> ['lista' => FichaSocioeconomica::listaMaterialPisos(),
    						'titulo' => '5.El material predominante en los pisos es:', 
							'idselect' => 'selectMaterialPredominantePisos', 
							'idtext' => 'txtMaterialPredominantePisos',
                            'name' => 'materialpiso'],
    					6=> ['lista' => FichaSocioeconomica::listaTipoAlumbrado(),
    						'titulo' => '6.Tipo de alumbrado público de su vivienda', 
							'idselect' => 'selectTipoAlumbrado', 
							'idtext' => 'txtTipoAlumbrado',
                            'name' => 'tipoalumrado'],
    					7=> ['lista' => FichaSocioeconomica::listaAbastecimientoAgua(),
    						'titulo' => '7.El abastecimiento de agua procede de:', 
							'idselect' => 'selectAbastecimientoAgua', 
							'idtext' => 'txtAbastecimientoAgua',
                            'name' => 'abastecimientoagua'],
    					8=> ['lista' => FichaSocioeconomica::listaServicioHigienico(),
    						'titulo' => '8.El servicio higienico de su casa esta conectado a:', 
							'idselect' => 'selectServicioHigienico', 
							'idtext' => '',
                            'name' => 'serviciohigienico']);
    }
    //1
    private static function listaTipoVivienda(){
    	return array(	0=> ['codigo' => 0, "descripcion" => "< Seleccione >"],
                        1=> ['codigo' => 1, "descripcion" => "Casa Independiente"],
    					2=> ['codigo' => 2, "descripcion" => "Departamento en Edificio"],
    					3=> ['codigo' => 3, "descripcion" => "Vivienda en Quinta"],
    					4=> ['codigo' => 4, "descripcion" => "Vivienda en casa de vecindad (Callejón, solar o corralón)"],
    					5=> ['codigo' => 5, "descripcion" => "Choza o cabaña"],
    					6=> ['codigo' => 6, "descripcion" => "Vivienda improvisada"],
    					7=> ['codigo' => 7, "descripcion" => "Local no destinado para habitación humana"],
    					8=> ['codigo' => 8, "descripcion" => "Otro (Especifique)"]);
    }
    //2
    private static function listaSuViviendaEs(){
    	return array(	0=> ['codigo' => 0, "descripcion" => "< Seleccione >"],
                        1=> ['codigo' => 1, "descripcion" => "¿Alquilada?"],
    					2=> ['codigo' => 2, "descripcion" => "¿Propia, pagandola a plazas?"],
    					3=> ['codigo' => 3, "descripcion" => "¿Propia totalmente pagada?"],
    					4=> ['codigo' => 4, "descripcion" => "¿Propia por invasión?"],
    					5=> ['codigo' => 5, "descripcion" => "¿Cedida por el centro de trabajo?"],
    					6=> ['codigo' => 6, "descripcion" => "¿Cedida por otro hogar o institución?"],
    					7=> ['codigo' => 7, "descripcion" => "Otro (Especifique)"],);
    }
    //3
    private static function listaMaterialParedes(){
    	return array(	0=> ['codigo' => 0, "descripcion" => "< Seleccione >"],
                        1=> ['codigo' => 1, "descripcion" => "¿Ladrillo o bloque de cemento?"],
    					2=> ['codigo' => 2, "descripcion" => "¿Piedra o sillar con cal o cemento?"],
    					3=> ['codigo' => 3, "descripcion" => "¿Adobe o tapia?"],
    					4=> ['codigo' => 4, "descripcion" => "¿Quincha (Caña con barro)?"],
    					5=> ['codigo' => 5, "descripcion" => "¿Piedra con barro?"],
    					6=> ['codigo' => 6, "descripcion" => "¿Madera?"],
    					7=> ['codigo' => 7, "descripcion" => "¿Estera?"],
    					8=> ['codigo' => 8, "descripcion" => "Otro (Especifique)"],);
    }
    //4
    private static function listaMaterialTecho(){
    	return array(	0=> ['codigo' => 0, "descripcion" => "< Seleccione >"],
                        1=> ['codigo' => 1, "descripcion" => "¿Concreto armado?"],
    					2=> ['codigo' => 2, "descripcion" => "¿Madera?"],
    					3=> ['codigo' => 3, "descripcion" => "¿Tejas?"],
    					4=> ['codigo' => 4, "descripcion" => "¿Plancha de calamina, fibra de cemento o similares?"],
    					5=> ['codigo' => 5, "descripcion" => "¿Caña o estera con torta de barro?"],
    					6=> ['codigo' => 6, "descripcion" => "¿Estera?"],
    					7=> ['codigo' => 7, "descripcion" => "¿Paja, hojas de palmera?"],
    					8=> ['codigo' => 8, "descripcion" => "Otro (Especifique)"],);
    }
    //5
    private static function listaMaterialPisos(){
    	return array(	0=> ['codigo' => 0, "descripcion" => "< Seleccione >"],
                        1=> ['codigo' => 1, "descripcion" => "¿Parquet o madera pulida?"],
    					2=> ['codigo' => 2, "descripcion" => "¿Láminas asfálticas, vinílicos o similares?"],
    					3=> ['codigo' => 3, "descripcion" => "¿Losetas, terrazos o similares?"],
    					4=> ['codigo' => 4, "descripcion" => "¿Madera (Entablados)?"],
    					5=> ['codigo' => 5, "descripcion" => "¿Cemento?"],
    					6=> ['codigo' => 6, "descripcion" => "¿Tierra?"],
    					7=> ['codigo' => 7, "descripcion" => "Otro (Especifique)"],);
    }
    //6
    private static function listaTipoAlumbrado(){
    	return array(	0=> ['codigo' => 0, "descripcion" => "< Seleccione >"],
                        1=> ['codigo' => 1, "descripcion" => "¿Electricidad?"],
    					2=> ['codigo' => 2, "descripcion" => "¿Kerosene (Mechero/Lamparín)?"],
    					3=> ['codigo' => 3, "descripcion" => "¿Petróleo / Gas (Lámpara)?"],
    					4=> ['codigo' => 4, "descripcion" => "¿Vela?"],
    					5=> ['codigo' => 5, "descripcion" => "Otro (Especifique)"],
    					6=> ['codigo' => 6, "descripcion" => "NO TIENE"],);
    }
    //7
    private static function listaAbastecimientoAgua(){
    	return array(	0=> ['codigo' => 0, "descripcion" => "< Seleccione >"],
                        1=> ['codigo' => 1, "descripcion" => "¿Red pública dentro de la vivienda?"],
    					2=> ['codigo' => 2, "descripcion" => "¿Red pública fuera de la vivienda, pero dentro del edificio?"],
    					3=> ['codigo' => 3, "descripcion" => "¿Pilón de uso público?"],
    					4=> ['codigo' => 4, "descripcion" => "¿Camión - cisterna u otro similar?"],
    					5=> ['codigo' => 5, "descripcion" => "¿Pozo?"],
    					6=> ['codigo' => 6, "descripcion" => "¿Río, acequia, manantial o similar?"],
    					7=> ['codigo' => 7, "descripcion" => "Otro (Especifique)"],);
    }
    //8
    private static function listaServicioHigienico(){
    	return array(	0=> ['codigo' => 0, "descripcion" => "< Seleccione >"],
                        1=> ['codigo' => 1, "descripcion" => "¿Red pública dentro de la vivienda?"],
    					2=> ['codigo' => 2, "descripcion" => "¿Red pública fuera de la vivienda, pero dentro del edificio?"],
    					3=> ['codigo' => 3, "descripcion" => "¿Pozo séptico?"],
    					4=> ['codigo' => 4, "descripcion" => "¿Pozo ciego o negro / letrina?"],
    					5=> ['codigo' => 5, "descripcion" => "¿Río, acequia o canal?"],
    					6=> ['codigo' => 6, "descripcion" => "NO TIENE"],);
    }
    public static function listaTipoVia(){
        return array(   1=> ['codigo' => 1, "descripcion" => "Avenida"],
                        2=> ['codigo' => 2, "descripcion" => "Jirón"],
                        3=> ['codigo' => 3, "descripcion" => "Calle"],
                        4=> ['codigo' => 4, "descripcion" => "Pasaje"],
                        5=> ['codigo' => 5, "descripcion" => "Carretera"],
                        6=> ['codigo' => 6, "descripcion" => "Otro"],);
    }
}
