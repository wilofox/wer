function _$(x){return document.getElementById(x);}

function addEvent(obj,fun,type){
	
	if(obj.addEventListener){
		obj.addEventListener(type,fun,false);
	}else if(obj.attachEvent){
		var f=function(){
			fun.call(obj,window.event);
		}
		obj.attachEvent('on'+type,f);
		obj[fun.toString()+type]=f;
	}else{
		obj['on'+type]=fun;
	}
}

function removeEvent(obj,fun,type){
	if(obj.removeEventListener){
		obj.removeEventListener(type,fun,false);
	}else if(obj.detachEvent){
		obj.detachEvent('on'+type,obj[fun.toString()+type]);
		obj[fun.toString()+type]=null;
	}else{
		obj['on'+type]=function(){}
	}
		
}
function cancelEv(e){
	e=e || window.event;
	if(e.preventDefault)
		e.preventDefault();
	else
		e.returnValue=false;
}
function stopEv(e){
	e=e || window.event;
	if(e.stopPropagation)
		e.stopPropagation();
	else
		e.cancelBubble=true;
}
function arrastrable(o){

	var o=o || this;
	this.style.cursor='move';
	o.style.cssFloat=o.style.styleFloat='none';
	o.style.position='absolute';
	addEvent(this,function(e){
		e=e || window.event;
		cancelEv(e);
		stopEv(e);
		this.cx0=e.clientX;
		this.cy0=e.clientY;
		this.ox=parseInt(o.style.left) || 0;
		this.oy=parseInt(o.style.top) || 0;
		addEvent(this,this.arrastrar,'mousemove');
	},'mousedown');
	this.arrastrar=function(e){
		e=e || window.event;
		cancelEv(e);
		stopEv(e);
		o.style.left=this.ox-this.cx0+e.clientX+'px';
		o.style.top=this.oy-this.cy0+e.clientY+'px';
	}
	addEvent(this,function(e){
		e=e || window.event;
		cancelEv(e);
		stopEv(e);
		removeEvent(this,this.arrastrar,'mousemove');
	},'mouseup');
	addEvent(this,function(e){
		e=e || window.event;
		cancelEv(e);
		stopEv(e);
		removeEvent(this,this.arrastrar,'mousemove');
	},'mouseout');
}
onload=function(){
	arrastrable.call(_$('pp'),_$('productos'));
}