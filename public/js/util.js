
function downloadFile(url,data={},cbSuccess,cbFail,cbPrepare,type = "json"){
	if(!url){
		console.log("downalodFile : URL no válido")
		return false;
	}
	$.fileDownload(url,{
		httpMethod: 'POST',
		dataType: type, // data type of response
		contentType: "application/json",
		data: data,
		prepareCallback: function(url){
			_showLoader();
			if(cbPrepare){
				cbPrepare(url);
			}
		},
		successCallback:function(url){
			_hideLoader();
			if(cbSuccess){
				cbSuccess(url);
			}
		},
		failCallback : function(responseHtml, url, error){
			_hideLoader();
			if(cbFail){
				cbFail(responseHtml,url,error);
			}
		}
	});
}

function cargarContenido() {
	// $('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="tooltip"]').tooltip();
}

function crearEventoBotonTable(nombreButton,callback,type="button") {
	$(nombreButton).off("click");
	// console.log("btn presionado: "+nombreButton);
	if(type=="button"){
		$(nombreButton).click(function(e) {
			e.preventDefault();
			callback(this);
		});
	}else{
		$(nombreButton).click(function(e) {
			callback(this);
		});
	}
}

function showConfirm(title,mensaje,nombreButton = 'Confirmar',callback){
	$("#title_modal_confirm").text(title);
	$("#body_modal_confirm").text(mensaje);
	$("#btn_modal_confirm").html(nombreButton);
	$('#modal_confirm').modal('show');

	$("#btn_modal_confirm").off("click");
	$("#btn_modal_confirm").click(function(e){
		e.preventDefault();
		callback();
	});
}

function toast(tipo,time,mensaje,titulo = ''){
	var fondo = '';
	var colorText = '';
	if(tipo.toLowerCase() == 'success'){
		fondo = '#0bc114';  // Background color of the toast
    	colorText = '#ffffff';
	}else {
		fondo = '#ff0000';
    	colorText = '#ffffff';
	}
	$.toast({
	    heading: titulo,
	    text: mensaje,
	    allowToastClose: false,
	    stack: false,
	    position: 'top-center',
	    hideAfter: time,
	    loader: false,  // Whether to show loader or not. True by default
    	bgColor: fondo,  // Background color of the toast
    	textColor: colorText,
    	textAlign: 'center'
	});
	
}

function toastInfo(tipo,time,mensaje,titulo = '')
{	
	var icon = '';
	var heading = '';
	switch(tipo.toLowerCase())
	{
		case "warning":
			icon = "warning";
			heading = "Advertencia";
		break;
		case "success":
			icon ="success";
			heading = "Éxito";
		break;
		case "error":
			icon = "error";
			heading = "Error";
		break;
		default :
			icon = "info";
			heading = "Información";
		break;
	}
	if(titulo){
		heading = titulo;
	}
	$.toast({
	    text: mensaje, // Text that is to be shown in the toast
	    heading: heading, // Optional heading to be shown on the toast
	    icon: icon, // Type of toast icon
	    showHideTransition: 'plain', // fade, slide or plain
	    allowToastClose: true, // Boolean value true or false
	    hideAfter: time, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
	    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
	    position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
	    
	    
	    textAlign: 'left',  // Text alignment i.e. left, right or center
	    loader: false,  // Whether to show loader or not. True by default
    	// loaderBg: '#992d48',  // Background color of the toast loader
	});
}

function callSvc(url,data,callback,async = true,dataType = 'json'){
	$.ajax({
	    url : url,
	    data : data,
	    type : 'POST',
	    async: async ,
	    dataType : dataType,
	    beforeSend: function() {
	        _showLoader();
	    },
	    success : function(response) {
	        if(response.status == 98){
	        	// cargar modal con el login
	        	$("#dialog-modal").html(response.html);
	        	$("#modal-login").modal('show');
	        }else{
	        	callback(response);
	        }
	    },
	    error : function(xhr, status) {
	        console.log("error en peticion ajax en la url: "+url+", con error: "+xhr);
	    },
	    complete : function(xhr, status) {
	    	_hideLoader();
	    }
	});
}


function loadDialogUi(url,data,title,callback,async = true){
	$.ajax({
	    url : url,
	    data : data,
	    type : 'POST',
	    async: async ,
	    dataType : 'json',
	    beforeSend: function() {
	        _showLoader();
	    },
	    success : function(response) {
	        if(response.status == 98){
	        	// cargar modal con el login
	        	$("#dialog-modal").html(response.html);
	        	$("#modal-login").modal('show');
	        }else if(response.status == 2){
	        	$("#modal_general").html(response.data.html);
				$("#title_modal").text(title);
				$("#modal_general").modal("show");
	        }
	        if(callback){
	        	callback(response);
	        }
	    },
	    error : function(xhr, status) {
	        console.log("error en peticion ajax en la url: "+url+", con error: "+xhr);
	    },
	    complete : function(xhr, status) {
	    	_hideLoader();
	    }
	});
	
}

function loadDialogUiHtml(url,data,title,callback,async = true){
	$.ajax({
	    url : url,
	    data : data,
	    type : 'POST',
	    async: async ,
	    dataType : 'html',
	    beforeSend: function() {
	        _showLoader();
	    },
	    success : function(response) {
        	$("#modal_general").html(response);
			$("#title_modal").text(title);
			$("#modal_general").modal("show");
	        if(callback){
	        	callback(response);
	        }
	    },
	    error : function(xhr, status) {
	        console.log("error en peticion ajax en la url: "+url+", con error: "+xhr);
	    },
	    complete : function(xhr, status) {
	    	_hideLoader();
	    }
	});
	
}

function _showLoader() {
	$("#load").show();
	$("body").css("overflow","hidden");
}

function _hideLoader() {
	$("#load").hide();
	$("body").removeAttr("style");
}