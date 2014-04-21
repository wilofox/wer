<?php
/** 
 * @author Williams Mendez
 * @example	$calendario = new Calendario();
		$eventos = array(5=>array(
								   array(
								   			'evento'=>'Feria',
								   			'descripcion'=>"Descripcion de la Feria"
								   		),
								   	array(
								   			'evento'=>'Examen',
								   			'descripcion'=>'Descripcion de nuestro Examen'
								   		)
								   ),
						 12=>array(
						 			array(
						 					'evento'=>'Entrega de Reportes',
						 					'descripcion'=>'Se describe la entrega de reportes'
						 				)
						 		  )
						);
		$this->view->calendario = $calendario->getCalendario($eventos); 
 * 
 *
 */
class Calendario {
	
	/**
	 * Metodo que calcula el calendario para
	 * un determinado mes de cualquier año.
	 *
	 * @param array	$eventos
	 * @param string $date	 
	 * @return string
	 */
	public function getCalendario($eventos, $date = null) {
		if (is_null ( $date )) {
			$fecha = split ( '-', date ( 'Y-m-d' ) );
		} else {
			$fecha = split ( '-', $date );
		}
		$month = $fecha [1];
		$year = $fecha [0];
		
		$fila = 0;
		$filas = 5;
		if (! $this->esBisiesto ( $year )) {
			if ($month == 2) {
				$d = getdate ( strtotime ( $year . '-2-1' ) );
				if ($d ['wday'] == 0) {
					$filas --;
				}
			}
		}
		
		$primerDiaMes = $this->getPrimerDia ( $year, $month );
		
		$HTML = '<table><tr>
						<td><b>Domingo</b></td>
						<td><b>Lunes</b></td>
						<td><b>Martes</b></td>
						<td><b>Miercoles</b></td>
						<td><b>Jueves</b></td>
						<td><b>Viernes</b></td>
						<td><b>Sabado</b></td>
					</tr>';
		$CantDias = $this->getDaysInMonth ( $month, $year );
		$DiaActual = 1;
		while ( $fila < $filas ) {
			$HTML .= '<tr>';
			for($i = 0; $i < 7; $i ++) {
				if (($fila == 0 && $i < $primerDiaMes) || ($DiaActual > $CantDias)) {
					$HTML .= '<td></td>';
				} else {
					if ($DiaActual == $fecha [2]) {
						$HTML .= $this->setDia ( $DiaActual, isset ( $eventos [$DiaActual] ) ? $eventos [$DiaActual] : null, true );
						//$HTML .= '<td><span style="color:red;">'.$DiaActual.'</span></td>';
					} else {
						$HTML .= $this->setDia ( $DiaActual, isset ( $eventos [$DiaActual] ) ? $eventos [$DiaActual] : null );
						//$HTML .= '<td>'.$DiaActual.'</td>';
					}
					$DiaActual ++;
				}
			}
			$HTML .= '</tr>';
			$fila ++;
		}
		
		return $HTML . '</table>';
	
	}
	/**
	 * Le da formato a un cada dia en el calendario,
	 * tomando en cuenta si hay algun evente para 
	 * el dia en cuestion
	 *
	 * @param Integer $dia
	 * @param array $eventos
	 * @param bool $esHoy
	 * @return string
	 */
	private function setDia($dia, $eventos, $esHoy = false) {
		$ev = '';
		if ($esHoy) {
			$estiloEventos = 'color:red; font-size:12px;';
			$estiloDia = 'background:yellow; font-size:11.5px;';
		} else {
			$estiloEventos = '';
			$estiloDia = 'background:pink; font-size:11px;';
		}
		if (! is_null ( $eventos )) {
			foreach ( $eventos as $evento ) {
				$ev .= "<div><span style='$estiloEventos' title='{$evento['descripcion']}'>{$evento['evento']}</span></div>";
			}
		}
		
		$html = "<td style='$estiloDia; width:75px; height:75px; font-weight:bold;' >$dia<div></div>" . $ev . '</td>';
		
		return $html;
	
	}
	
	/**
	 * Busca que dia de la semana cae el primer dia de un mes
	 * de cualquier año en formato numerico, esto es, un numero
	 * del 0-6, siendo Domingo el dia 0 y sabado el dia 6
	 *
	 * @param Integer $year
	 * @param Integer $month
	 * @return Integer
	 */
	private function getPrimerDia($year, $month) {
		$d = getdate ( strtotime ( $year . '-' . $month . '-1' ) );
		return $d ['wday'];
	}
	/**
	 * Calcular los dias que tiene cualquier mes, cualquier año 
	 */
	private function getDaysInMonth($month, $year) {
		$days = null;
		if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
			$days = 31;
		elseif ($month == 4 || $month == 6 || $month == 9 || $month == 11)
			$days = 30;
		else if ($month == 2) {
			if ($this->esBisiesto ( $year ))
				$days = 29;
			else
				$days = 28;
		}
		return $days;
	}
	/**
	 * Calcula si el año es bisiesto
	 *
	 * @param Integer $Year
	 * @return boolean
	 */
	private function esBisiesto($Year) {
		if ((($Year % 4) == 0) && (($Year % 100) != 0) || (($Year % 400) == 0))
			return true;
		else
			return false;
	}

}
?>
