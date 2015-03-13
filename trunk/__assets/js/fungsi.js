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
			urlnya = "klasifikasi_pbbkb_pertamina";
			kolom[modnya] = [	
				{field:'NmBB',title:'Nama Bahan Bakar',width:200, halign:'center'},
				{field:'NmKlass',title:'Nama Klasifikasi',width:200, halign:'center'},
				{field:'Persentasi',title:'Persentase(%)',width:200, halign:'center'},
				{field:'FieldAktif',title:'Status Klasifikasi',width:110, halign:'center'},
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
				{field:'LastDateSIUP',title:'Masa Berlaku SIUP',width:150, halign:'center', align:'center'},
				{field:'NoNPWP',title:'No. NPWP',width:150, halign:'center'},
				{field:'NmOwner',title:'Nama Pemilik',width:200, halign:'center'},
				{field:'OwnerAdss',title:'Alamat Pemilik',width:200, halign:'center'},
				{field:'OwnerIdentity',title:'No. Identitas',width:150, halign:'center'},
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
				{field:'KdKlasifikas',title:'Klasifikasi Perusahaan',width:170, halign:'center'},
				{field:'WPNoSIUP',title:'No. SIUP',width:150, halign:'center'},
				{field:'WPLastDateSIUP',title:'Masa Berlaku SIUP',width:150, halign:'center'},
				{field:'WPNoNPWP',title:'No. NPWP',width:150, halign:'center'},
				{field:'NmOwner',title:'Nama Pemilik',width:200, halign:'center'},
				{field:'OwnerAdss',title:'Alamat Pemilik',width:200, halign:'center'},
				{field:'OwnerIdentity',title:'No. Identitas',width:150, halign:'center'},
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
		
		//Modul Setting
		case "tahun_pajak":
			judulnya = "Data Tahun Pajak";
			urlnya = "tahun_pajak";
			kolom[modnya] = [	
				{field:'ThnPajak',title:'Tahun Pajak',width:150, halign:'center'},
			];
		break;
		case "target_pajak":
			judulnya = "Data Target Pajak";
			urlnya = "target_pajak";
			kolom[modnya] = [	
				{field:'ThnPajak',title:'Tahun Pajak',width:150, halign:'center', align:'center'},
				{field:'TargetTaxAPBD',title:'Target APBD',width:200, halign:'center', align:'right'},
				{field:'TargetTaxAPBDP',title:'Target APBDP',width:200, halign:'center', align:'right'},
			];
		break;
		case "tingkat_daerah":
			judulnya = "Data Tingkat Daerah";
			urlnya = "tingkat_daerah";
			kolom[modnya] = [	
				{field:'KdTk',title:'Kode Tk.',width:150, halign:'center'},
				{field:'KetTk',title:'Keterangan Tk.',width:200, halign:'center'},
			];
		break;
		case "jabatan":
			judulnya = "Data Jabatan";
			urlnya = "jabatan";
			kolom[modnya] = [	
				{field:'Jabatan',title:'Jabatan',width:150, halign:'center'},
				{field:'KetJabatan',title:'Keterangan jabatan',width:200, halign:'center'},
			];
		break;
		case "owner":
			judulnya = "Data Lembaga Pengguna/Owner";
			urlnya = "owner";
			kolom[modnya] = [	
				{field:'NmDinas',title:'Nama Dinas',width:150, halign:'center'},
				{field:'AdssDinas',title:'Alamat',width:200, halign:'center'},
				{field:'NmKabKot',title:'Kabupaten',width:200, halign:'center'},
				{field:'KetTk',title:'Tingkat Daerah',width:150, halign:'center'},
				{field:'nama_kepala_dinas',title:'Nama Kepala Dinas',width:200, halign:'center'},
				{field:'nama_kepala_seksi',title:'Nama Kepala Seksi',width:200, halign:'center'},
			];
		break;
		case "user_level":
			judulnya = "Data User Level";
			urlnya = "user_level";
			kolom[modnya] = [	
				{field:'UserLevel',title:'User Level',width:200, halign:'center'},
			];
		break;
		case "user_manajemen":
			judulnya = "Data User Manajemen";
			urlnya = "user_manajemen";
			kolom[modnya] = [	
				{field:'UserNm',title:'Username',width:250, halign:'center'},
				{field:'UserLevel',title:'User Level',width:250, halign:'center'},
				{field:'Jabatan',title:'Jabatan',width:250, halign:'center'},
				{field:'TglAwal',title:'Tanggal Awal Jabatan',width:150, halign:'center'},
				{field:'TglAkhir',title:'Tanggal Akhir Jabatan',width:150, halign:'center'},
				{field:'RecAktif',title:'Status User',width:150, halign:'center'},
			];
		break;
		//end setting
		
		//modul pungutan pajek
		case "pbbkb":
			judulnya = "Data PBBKB";
			urlnya = "pbbkb";
			kolom[modnya] = [	
				{field:'TglInput',title:'Tanggal Input',width:150, halign:'center',align:'center'},
				{field:'TglLaporan',title:'Tanggal Laporan',width:150, halign:'center',align:'center'},
				{field:'TaxBulan',title:'Pajak Bulan',width:150, halign:'center',align:'center'},
				{field:'TaxThn',title:'Pajak Tahun',width:100, halign:'center',align:'center'},
				{field:'NmCP',title:'Wajib Pungut',width:250, halign:'center'},
				{field:'NmWP',title:'Wajib Pajak',width:250, halign:'center'},
				{field:'NmBB',title:'Jenis Bahan Bakar',width:250, halign:'center'},
				{field:'NmKlas',title:'Klasifikasi',width:250, halign:'center'},
				{field:'QtyBB',title:'Quantity',width:100, halign:'center',align:'right'},
				{field:'Pay',title:'Pembayaran',width:250, halign:'center',align:'right'},
				{field:'Tax',title:'Pajak',width:250, halign:'center',align:'right'},
			];
		break;
		case "pbbkb_pertamina":
			judulnya = "Data PBBKB Dari Wajib Pungut Khusus Pertamina Wilayah per Klasifikasi Sektor";
			urlnya = "pbbkb_pertamina";
			kolom[modnya] = [	
				{field:'TglInput2',title:'Tanggal Input',width:150, halign:'center'},
				{field:'TglLaporan2',title:'Tanggal Laporan',width:150, halign:'center'},
				{field:'TaxBulan2',title:'Pajak Bulan',width:250, halign:'center'},
				{field:'TaxThn2',title:'Pajak Tahun',width:250, halign:'center'},
				{field:'NmCP',title:'Wajib Pungut',width:250, halign:'center'},
				{field:'NmBB',title:'Jenis Bahan Bakar',width:250, halign:'center'},
				{field:'NmKlas',title:'Klasifikasi',width:250, halign:'center'},
				{field:'Pay2',title:'Pembayaran',width:250, halign:'center'},
				{field:'Tax2',title:'Pajak',width:250, halign:'center'},
			];
		break;
		
		case "pbbkb_pertamina_sektor":
			judulnya = "Data PBBKB Dari Wajib Pungut Khusus Pertamina Wilayah per Klasifikasi Sektor";
			urlnya = "pbbkb_pertamina_sektor";
			kolom[modnya] = [	
				{field:'TglInput2',title:'Tanggal Input',width:150, halign:'center'},
				{field:'TglLaporan2',title:'Tanggal Laporan',width:150, halign:'center'},
				{field:'TaxBulan2',title:'Pajak Bulan',width:250, halign:'center'},
				{field:'TaxThn2',title:'Pajak Tahun',width:250, halign:'center'},
				{field:'NmCP',title:'Wajib Pungut',width:250, halign:'center'},
				{field:'NmBB',title:'Jenis Bahan Bakar',width:250, halign:'center'},
				{field:'NmKlass',title:'Klasifikasi',width:250, halign:'center'},
				{field:'Pay2',title:'Pembayaran',width:250, halign:'center'},
			];
		break;
		
		case "pbbkb_bank":
			judulnya = "Data Setoran PBBKB ke Bank";
			urlnya = "pbbkb_bank";
			kolom[modnya] = [	
				{field:'TglInput3',title:'Tanggal Input',width:150, halign:'center'},
				{field:'TglBankPaid',title:'Tanggal Bayar Bank',width:150, halign:'center'},
				{field:'TaxBulan3',title:'Pajak Bulan',width:250, halign:'center'},
				{field:'TaxThn3',title:'Pajak Tahun',width:250, halign:'center'},
				{field:'NmCP',title:'Wajib Pungut',width:250, halign:'center'},
				{field:'NmBank',title:'Nama Bank',width:250, halign:'center'},
				{field:'QtyBB3',title:'Quantity Pembelian',width:250, halign:'center'},
				{field:'Pay3',title:'Nominal Pajak',width:250, halign:'center'},
				{field:'Tax3',title:'Nominal Pembayaran',width:250, halign:'center'},
			];
		break;
		//end modul pungutan pajek
		
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
		//Modul Master
		case "provinsi":
			var lebar = getClientWidth()-990;
			var tinggi = getClientHeight()-535;
			var judulwindow = 'Form Data Provinsi';
			var table="cl_provinsi";
		break;
		// angkanya gede formnya jadi kecil
		case "kabupaten":
			var lebar = getClientWidth()-910;
			var tinggi = getClientHeight()-515;
			var judulwindow = 'Form Data Kabupaten';
			var table="cl_kabupaten_kota";
		break;
		case "jenis_perusahaan":
			var lebar = getClientWidth()-930;
			var tinggi = getClientHeight()-530;
			var judulwindow = 'Form Jenis Perusahaan';
			var table="cl_jenis_perusahaan";
		break;
		case "jenis_bahanbakar":
			var lebar = getClientWidth()-930;
			var tinggi = getClientHeight()-530;
			var judulwindow = 'Form Jenis Bahan Bakar';
			var table="cl_jenis_bahan_bakar";
		break;
		case "klasifikasi_pbbkb":
			var lebar = getClientWidth()-850;
			var tinggi = getClientHeight()-480;
			var judulwindow = 'Form Klasifikasi PBB-KB';
			var table="cl_klasifikasi_pbbkb";
		break;
		case "klasifikasi_pbbkb_pertamina":
			var lebar = getClientWidth()-850;
			var tinggi = getClientHeight()-450;
			var judulwindow = 'Klasifikasi PBB-KB Pertamina';
			var table="cl_klasifikasi_pbbkb_pertamina";
		break;
		case "profil_wajib_pungut":
			var lebar = getClientWidth()-935;
			var tinggi = getClientHeight()-300;
			var judulwindow = 'Profil Wajib Pungut';
			var table="tbl_wajib_pungut_pertamina_wil";
		break;
		case "profil_wajib_pajak":
			var lebar = getClientWidth()-935;
			var tinggi = getClientHeight()-265;
			var judulwindow = 'Profil Wajib Pajak';
			var table="tbl_wajib_pajak_pertamina_daerah";
		break;
		case "bank":
			var lebar = getClientWidth()-985;
			var tinggi = getClientHeight()-500;
			var judulwindow = 'Profil Data Bank';
			var table="cl_bank";
		break;
		
		//Modul Setting
		case "tahun_pajak":
			var lebar = getClientWidth()-990;
			var tinggi = getClientHeight()-535;
			var judulwindow = 'Tahun Pajak';
			var table="cl_tahun_pajak";
		break;
		case "target_pajak":
			var lebar = getClientWidth()-980;
			var tinggi = getClientHeight()-485;
			var judulwindow = 'Form Target Pajak';
			var table="target_pajak";
		break;
		case "tingkat_daerah":
			var lebar = getClientWidth()-990;
			var tinggi = getClientHeight()-535;
			var judulwindow = 'Form Tingkat Daerah';
			var table="cl_tingkat_daerah_pengguna";
		break;
		case "jabatan":
			var lebar = getClientWidth()-930;
			var tinggi = getClientHeight()-510;
			var judulwindow = 'Form Setting Jabatan';
			var table="cl_jabatan_user";
		break;
		case "owner":
			var lebar = getClientWidth()-900;
			var tinggi = getClientHeight()-400;
			var judulwindow = 'Form Lembaga Pengguna';
			var table="cl_tingkat_daerah_pengguna";
		break;
		case "user_level":
			var lebar = getClientWidth()-990;
			var tinggi = getClientHeight()-535;
			var judulwindow = 'Form User Level';
			var table="cl_level_user";
		break;
		case "user_manajemen":
			var lebar = getClientWidth()-935;
			var tinggi = getClientHeight()-365;
			var judulwindow = 'User Manajemen';
			var table="tbl_user";
		break;
		//End Modul Setting
		
		//Modul Pungutan Pajak
		case "pbbkb":
			var lebar = getClientWidth()-800;
			var tinggi = getClientHeight()-350;
			var judulwindow = 'PBBKB';
			var table="tbl_pungutan_pbbkb";
			//var field_id="tbl_pungutan_pbbkb";
		break;
		case "pbbkb_pertamina":
			var lebar = getClientWidth()-800;
			var tinggi = getClientHeight()-385;
			var judulwindow = 'PBBKB-PERTAMINA';
			var table="tbl_punggut_pbbkb_pertamina";
			//var field_id="tbl_pungutan_pbbkb";
		break;
		case "pbbkb_pertamina_sektor":
			var lebar = getClientWidth()-800;
			var tinggi = getClientHeight()-330;
			var judulwindow = 'PBBKB-PERTAMINA SEKTOR';
			var table="tbl_punggut_pbbkb_pertamina";
			//var field_id="tbl_pungutan_pbbkb";
		break;
		case "pbbkb_bank":
			var lebar = getClientWidth()-800;
			var tinggi = getClientHeight()-345;
			var judulwindow = 'PBBKB PEMBAYARAN BANK';
			var table="tbl_pembayaran_pungutan_bank";
			//var field_id="tbl_pungutan_pbbkb";
		break;
		
		//EndModul Pungutan Pajak
	}
	
	switch(type){
		case "add":
			$.post(host+'home/getdisplay/'+modulnya+'/'+submodulnya+'/form/', {'editstatus':'add'}, function(resp){
				windowForm(resp, judulwindow, lebar, tinggi);
			});
		break;
		case "edit":
		case "delete":
			var row = $("#grid_"+submodulnya).datagrid('getSelected');
			if(row){
				if(type=='edit'){
					$.post(host+'home/getdisplay/'+modulnya+'/'+submodulnya+'/form/', {'editstatus':'edit',id:row.id}, function(resp){
						windowForm(resp, judulwindow, lebar, tinggi);
					});
				}
				else{
					if(confirm("Apakah Data Ini Akan Dihapus ?")){
						$.post(host+'home/crud_na/'+table+'/delete/', {id:row.id}, function(r){
							if(r==1){
								$.messager.alert('SIPBB-KB',"Row Data Telah TerHapus",'info');
								$('#grid_'+submodulnya).datagrid('reload');
							}
							else{
								console.log(r)
								$.messager.alert('SIPBB-KB',"Row Data Gagal DiHapus",'error');
							}
						});	
					}
				}
			}
			else{
				$.messager.alert('SIPBB-KB',"Pilih Row Data Dalam Grid",'error');
			}
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
function fillCombo(url, SelID, value, value2, value3, value4){
	//if(Ext.get(SelID).innerHTML == "") return false;
	if (value == undefined) value = "";
	if (value2 == undefined) value2 = "";
	if (value3 == undefined) value3 = "";
	if (value4 == undefined) value4 = "";
	
	$('#'+SelID).empty();
	$.post(url, {"v": value, "v2": value2, "v3": value3, "v4": value4},function(data){
		$('#'+SelID).append(data);
	});

}
function formatDate(date) {
	var bulan=date.getMonth() +1;
	var tgl=date.getDate();
	if(bulan < 10){
		bulan='0'+bulan;
	}
	
	if(tgl < 10){
		tgl='0'+tgl;
	}
	return date.getFullYear() + "-" + bulan + "-" + tgl;
}		

function hit_pajak(mod){
	switch(mod){
		case "pbbkb":
			console.log($('#persentase').html());
			console.log($('#KdWP').val());
			if($('#persentase').html()!="" && $('#KdWP').val()!="" && $("#Pay").numberbox('getValue')!=""){
				var pajak;
				pajak=(parseFloat($("#Pay").numberbox('getValue')) * parseFloat($('#persentase').html()))/100;
				$('#Tax').numberbox('setValue',pajak);
				console.log(pajak);
			}
			else{
				$.messager.alert('Data PBB-KB',"Untuk Melakukan Kalkulasi Harap Pilih Data Wajib Pungut Dan Pembayaran!!",'info');
			}
		break;
		case "pertamina":
			console.log($('#persentase').html());
			console.log($('#KdWP').val());
			if($('#persentase').html()!="" && $('#KdWP2').val()!="" && $("#Pay2").numberbox('getValue')!=""){
				var pajak;
				pajak=(parseFloat($("#Pay2").numberbox('getValue')) * parseFloat($('#persentase').html()))/100;
				$('#Tax2').numberbox('setValue',pajak);
				console.log(pajak);
			}
			else{
				$.messager.alert('Data PBB-KB',"Untuk Melakukan Kalkulasi Harap Pilih Data Wajib Pungut Dan Pembayaran!!",'info');
			}
		break;
		case "bank":
			console.log($('#persentase').html());
			console.log($('#KdWP').val());
			if($('#KdCP3').val()!="" && $("#Pay3").numberbox('getValue')!=""){
				var pajak;
				pajak=(parseFloat($("#Pay3").numberbox('getValue')) * 10 )/100;
				$('#Tax3').numberbox('setValue',pajak);
				console.log(pajak);
			}
			else{
				$.messager.alert('Data PBB-KB',"Untuk Melakukan Kalkulasi Harap Pilih Data Wajib Pungut Dan Pembayaran!!",'info');
			}
		break;
	}
}