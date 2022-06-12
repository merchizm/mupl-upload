<SCRIPT language="JavaScript">
function OnSubmitForm()
{
  a=document.getElementById('form').style;
  a.display='none';
  b=document.getElementById('part2').style;
  b.display='inline';

  if(document.myform.operation[0].checked == true)
  {
    document.myform.action ="upload.php";
  }
  else
  if(document.myform.operation[1].checked == true)
  {
    document.myform.action ="transload.php?xfer=true";
  }
  return true;

}

function toggleuploadmode(file) {
	if (file) {
		document.getElementById('upfile').style.display='block';
		document.getElementById('upurl').style.display='none';
		document.getElementById('upform').action='index.php';
	} else {
		document.getElementById('upfile').style.display='none';
		document.getElementById('upurl').style.display='block';
		document.getElementById('upform').action='transload.php';
	}
}
function focusfield(fl) {
	if (fl.value=="Yüklemek İstediğiniz Dosya Linkini Girin / Yapıştırın.") {
		fl.value='';
		fl.style.color='black';
	}
}
</SCRIPT>

<SCRIPT language="JavaScript">
var checkobj
function agreesubmit(el){
checkobj=el
if (document.all||document.getElementById){
for (i=0;i<checkobj.form.length;i++){
var tempobj=checkobj.form.elements[i]
if(tempobj.type.toLowerCase()=="submit")
tempobj.disabled=!checkobj.checked
}
}
}

function defaultagree(el){
if (!document.all&&!document.getElementById){
if (window.checkobj&&checkobj.checked)
return true
else{
alert("Please read and accept terms to submit form")
return false
}
}
}
</script>

<?php include ("ads.html") ?>
<div style=text-align:center;vertical-align:middle;height:150px>
<div style=vertical-align:middle>
    <h1>Dosya Yükle!</h1>
		<center>
	<form enctype="multipart/form-data" name="myform" id="form" method="post" onSubmit="return OnSubmitForm();" style="display: inline;">
	Maksimum Dosya Boyutu: <?php echo $maxfilesize; ?> MB
	<div id="upfile">
		<input type="file" name="upfile" size="50" onchange="showoptions(this)" id="fileupload"><br />
	</div>
	<div id="upurl" style="display: none"> 
	<div class="form-group">
            <input type="text" id="from" name="from" value="" placeholder="Url" class="form-control" style=width:450px onfocus="focusfield(this)">
          </div><br />
	</div>
	
	<table border=0 cellpadding=0 cellspacing=0 align=center width=405>
	<tr>
	<td>
		<label class="radio">
            <input type="radio" name="operation" id="operation" data-toggle="radio" checked=""  onclick="toggleuploadmode(true);" value="1"  class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
            Dosya
          </label>
		  <label class="radio">
		 
            <input type="radio" name="operation" id="operation" data-toggle="radio"  onclick="toggleuploadmode(false);" value="2"  class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
            Url
          </label>
	
	
	</td>
	<td align=right><br>
	
	<label class="checkbox" for="agreecheck"><input checked="true" name="agreecheck" type="checkbox" onClick="agreesubmit(this)" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Yükleme <a href="./index.php?page=ks" target=_blank>Koşullarını</a> Kabul Ediyorum</label>
	</td>
	</tr>
	</table>
	<br />
	<input type="submit"  class="btn btn-block btn-lg btn-primary" value="Dosyayı Yükle!" id="upload" style=width:450px />	
	</form>
        <div id="part2" style="display: none;">
	Yükleme devam ediyor. Lütfen Bekleyin ...
        
</div>
</div>
</div>
</center>
		  

