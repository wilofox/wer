	function AjaxUpdate( target , param , path )
	{
		target = $(target);
		if ( !target ) return false;
		new Ajax.Updater(target,path,{method: "post",parameters: param});
	}

	function AjaxUpdatePeriodico( target , param , path , frequency )
	{	
		target = $(target);
		if ( !target ) return false;
		new Ajax.PeriodicalUpdater(target,path,{method: "post",parameters: param,frequency:frequency});
	}
	function msjEspera( target , path_msj )
	{
		AjaxUpdate( target , '' , path_msj );
	}