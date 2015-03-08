var myVar = setInterval(function(){
	d = new Date();
    t = d.toLocaleString();
	$('#waktu').html(d.toLocaleString());
},1000);

$(document).ready(function(){
    frmWidth = getClientWidth();
    frmHeight = getClientHeight();
	
	$('#bodyHt').layout();
	$('#bodyHt').layout('panel','west').panel({
		collapsible:false
	});
	$("#mainContainer").css('height',getClientHeight()-163);
	
	$('#accordionMenu').accordion({  
		height: getClientHeight()-178
	});
	
	

});

function loadUrl(obj, urls){
	$('.btn-highlight').removeClass("btn-highlight");
	obj.className += " btn-highlight";	
	
    $("#mainContainer").html("").addClass("loading");
	$.get(urls,function (html){
	    $("#mainContainer").html(html).removeClass("loading");
    });
}

function getClientHeight(){
	var theHeight;
	if (window.innerHeight)
		theHeight=window.innerHeight;
	else if (document.documentElement && document.documentElement.clientHeight) 
		theHeight=document.documentElement.clientHeight;
	else if (document.body) 
		theHeight=document.body.clientHeight;
	
	return theHeight;
}

var container;
function windowForm(html,judul,width,height){
    container = "win"+Math.floor(Math.random()*9999);
    $("<div id="+container+"></div>").appendTo("body");
    container = "#"+container;
    $(container).html(html);
    $(container).css('padding','5px');
    $(container).window({
       title:judul,
       width:width,
       height:height,
       autoOpen:false,
       maximizable:false,
       minimizable: false,
	   collapsible: false,
       resizable: false,
       closable:true,
       modal:true,
	   onBeforeClose:function(){	   
			$(container).window("close",true);
			$(container).window("destroy",true);
			return true;
	   }
    });
    $(container).window('open');        
}
function closeWindow(){
    $(container).window('close');
    $(container).html("");
}


function getClientWidth(){
	var theWidth;
	if (window.innerWidth) 
		theWidth=window.innerWidth;
	else if (document.documentElement && document.documentElement.clientWidth) 
		theWidth=document.documentElement.clientWidth;
	else if (document.body) 
		theWidth=document.body.clientWidth;

	return theWidth;
}

function genGrid(modnya, divnya){
	var kolom ={};
	var judulnya;
	var urlnya;
	
	switch(modnya){
		case "provinsi":
			judulnya = "Data Provinsi";
			urlnya = "provinsi";
			kolom[modnya] = [	
				{field:'KdProv',title:'Kode Provinsi',width:100, halign:'center'},
				{field:'NmProvinsi',title:'Nama Provinsi',width:150, halign:'center'},
			];
		break;
		case "kabupaten":
			judulnya = "Data Kota/Kabupaten";
			urlnya = "kabupaten";
			kolom[modnya] = [	
				{field:'NmProvinsi',title:'Nama Provinsi',width:150, halign:'center'},
				{field:'NmKabKot',title:'Nama Kota/Kabupaten',width:200, halign:'center'},
			];
		break;
		case "jenis_perusahaan":
			judulnya = "Data Jenis Perusahaan";
			urlnya = "jenis_perusahaan";
			kolom[modnya] = [	
				{field:'KdJenCP',title:'Kode Jenis Perusahaan',width:200, halign:'center'},
				{field:'NmJenCP',title:'Nama Jenis Perusahaan',width:200, halign:'center'},
			];
		break;
		case "jenis_bahanbakar":
			judulnya = "Data Jenis Bahan Bakar";
			urlnya = "jenis_bahanbakar";
			kolom[modnya] = [	
				{field:'KdBB',title:'Kode Jenis Bahan Bakar',width:200, halign:'center'},
				{field:'NmBB',title:'Nama Jenis Bahan Bakar',width:200, halign:'center'},
			];
		break;
		case "klasifikasi_pbbkb":
			judulnya = "Data Klasifikasi PBB-KB";
			urlnya = "klasifikasi_pbbkb";
			kolom[modnya] = [	
				{field:'NmKlas',title:'Nama Klasiifikasi',width:200, halign:'center'},
				{field:'Persentasi',title:'Persentase(%)',width:200, halign:'center'},
				{field:'FieldAktif',title:'Status Klasifikasi',width:100, halign:'center'},
			];
		break;
		case "klasifikasi_pbbkb_pertamina":
			judulnya = "Data Klasifikasi PBB-KB Pertamina";
			urlnya = "klasifikasi_pbbkb";
			kolom[modnya] = [	
				{field:'NmBB',title:'Nama Bahan Bakar',width:200, halign:'center'},
				{field:'Persentasi',title:'Persentase(%)',width:200, halign:'center'},
				{field:'FieldAktif',title:'Status Klasifikasi',width:100, halign:'center'},
			];
		break;
		case "profil_wajib_pungut":
			judulnya = "Data Profil Wajib Pungut";
			urlnya = "profil_wajib_pungut";
			kolom[modnya] = [	
				{field:'NmCP',title:'Nama Perusahaan',width:200, halign:'center'},
				{field:'AdssCP',title:'Alamat Perusahan',width:200, halign:'center'},
				{field:'NmKabKot',title:'Kabupaten',width:200, halign:'center'},
				{field:'NoSIUP',title:'No. SIUP',width:200, halign:'center'},
				{field:'LastDateSIUP',title:'Masa Berlaku SIUP',width:100, halign:'center'},
				{field:'NoNPWP',title:'Status No. NPWP',width:100, halign:'center'},
				{field:'NmOwner',title:'Nama Pemilik',width:100, halign:'center'},
				{field:'OwnerAdss',title:'Alamat Pemilik',width:100, halign:'center'},
				{field:'OwnerIdentity',title:'No. Identitas',width:100, halign:'center'},
			];
		break;
		case "profil_wajib_pajak":
			judulnya = "Data Profil Wajib Pajak";
			urlnya = "profil_wajib_pajak";
			kolom[modnya] = [	
				{field:'NmWP',title:'Nama Perusahaan',width:200, halign:'center'},
				{field:'AdssWP',title:'Alamat Perusahan',width:200, halign:'center'},
				{field:'NmKabKot',title:'Kabupaten',width:200, halign:'center'},
				{field:'NmJenCP',title:'Jenis Perusahaan',width:200, halign:'center'},
				{field:'NmKlas',title:'Klasifikasi Perusahaan',width:200, halign:'center'},
				{field:'WPNoSIUP',title:'No. SIUP',width:200, halign:'center'},
				{field:'WPLastDateSIUP',title:'Masa Berlaku SIUP',width:100, halign:'center'},
				{field:'WPNoNPWP',title:'Status No. NPWP',width:100, halign:'center'},
				{field:'NmOwner',title:'Nama Pemilik',width:100, halign:'center'},
				{field:'OwnerAdss',title:'Alamat Pemilik',width:100, halign:'center'},
				{field:'OwnerIdentity',title:'No. Identitas',width:100, halign:'center'},
			];
		break;
		case "bank":
			judulnya = "Data Bank";
			urlnya = "bank";
			kolom[modnya] = [	
				{field:'KdBank',title:'Kode Bank',width:200, halign:'center'},
				{field:'NmBank',title:'Nama Bank',width:200, halign:'center'},
			];
		break;		
	}
	
	$("#"+divnya).datagrid({
		title:judulnya,
        height:getClientHeight-74,
        width:getClientWidth-15,
		rownumbers:true,
		iconCls:'database',
        fit:true,
        striped:true,
        pagination:true,
        remoteSort: false,
        url:host+"home/getdata/"+urlnya,		
		nowrap: true,
        singleSelect:true,
		columns:[
            kolom[modnya]
        ],
		toolbar: '#tb_'+modnya,
	});
}


function genform(type, modulnya, submodulnya){
	switch(submodulnya){
		case "provinsi":
			var lebar = getClientWidth()-990;
			var tinggi = getClientHeight()-535;
			var judulwindow = 'Form Data Provinsi';
		break;
		// angkanya gede formnya jadi kecil
		case "kabupaten":
			var lebar = getClientWidth()-910;
			var tinggi = getClientHeight()-530;
			var judulwindow = 'Form Data Kabupaten';
		break;
		case "jenis_perusahaan":
			var lebar = getClientWidth()-930;
			var tinggi = getClientHeight()-530;
			var judulwindow = 'Form Jenis Perusahaan';
		break;
		case "jenis_bahanbakar":
			var lebar = getClientWidth()-930;
			var tinggi = getClientHeight()-530;
			var judulwindow = 'Form Jenis Bahan Bakar';
		break;
		case "klasifikasi_pbbkb":
			var lebar = getClientWidth()-930;
			var tinggi = getClientHeight()-488;
			var judulwindow = 'Form Klasifikasi PBB-KB';
		break;
		case "klasifikasi_pbbkb_pertamina":
			var lebar = getClientWidth()-930;
			var tinggi = getClientHeight()-475;
			var judulwindow = 'Klasifikasi PBB-KB Pertamina';
		break;
		case "profil_wajib_pungut":
			var lebar = getClientWidth()-935;
			var tinggi = getClientHeight()-325;
			var judulwindow = 'Profil Wajib Pungut';
		break;
		case "profil_wajib_pajak":
			var lebar = getClientWidth()-935;
			var tinggi = getClientHeight()-295;
			var judulwindow = 'Profil Wajib Pajak';
		break;
		case "bank":
			var lebar = getClientWidth()-985;
			var tinggi = getClientHeight()-510;
			var judulwindow = 'Profil Data Bank';
		break;
	}
	
	switch(type){
		case "add":
			$.post(host+'home/getdisplay/'+modulnya+'/'+submodulnya+'/form/', {'editstatus':'add'}, function(resp){
				windowForm(resp, judulwindow, lebar, tinggi);
			});
		break;
		case "edit":
		
		break;
	}
}

function submit_form(frm,func){
	var url = jQuery('#'+frm).attr("url");
    jQuery('#'+frm).form('submit',{
            url:url,
            onSubmit: function(){
                  return $(this).form('validate');
            },
            success:function(data){
				//$.unblockUI();
                if (func == undefined ){
                     if (data == "1"){
                        pesan('Data Sudah Disimpan ','Sukses');
                    }else{
                         pesan(data,'Result');
                    }
                }else{
                    func(data);
                }
            },
            error:function(data){
				//$.unblockUI();
                 if (func == undefined ){
                     pesan(data,'Error');
                }else{
                    func(data);
                }
            }
    });
}