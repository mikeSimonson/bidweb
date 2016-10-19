function setPageId(Id){
	document.getElementById("pageId").value = Id;
	//alert($("#pageId").val());
}

function setCategory(Ids){
	document.getElementById("category").value = Ids;
	//$("#category").val();
	$("#searchCat").submit();	
}

function setLocations(Ids){
	document.getElementById("location").value = Ids;
	//$("#location").val();
	$("#searchCat").submit();	
}

function setLocation(Ids){
	document.getElementById("location").value = Ids;
	//alert($("#location").val());
	getAllCatAccLoc($("#location").val());
	$("#alllcategories").click();
	
}

function getAllCatAccLoc(data){
	//alert(data);
		var xmlhttp;
	
		if(window.XMLHttpRequest){
  			xmlhttp=new XMLHttpRequest();
	  	}else{
  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  	}
		
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				var data = xmlhttp.responseText;
					
					if(data){
						$("#statuss").removeClass("error");
						$("#statuss").addClass("success");
						$("#statuss").fadeIn();
						//alert(data);
						document.getElementById("allCatAccLoc").innerHTML = data;											
					}
	    	}
  		}
	//alert(data);
            var url = "http://"+window.location.hostname;
		xmlhttp.open("GET", url+"/pages/allCatAccLoc.php?data=" + data , true);
		xmlhttp.send();	
}


function checkEmail(email){
		var xmlhttp;
		if(email == ''){
			$("#statuss").fadeOut();
		}
	
		if(window.XMLHttpRequest){
  			xmlhttp=new XMLHttpRequest();
	  	}else{
  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  	}
		
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				var data = xmlhttp.responseText;
				var index = data.search("T");
					var pos = index + 1;
					var pos2 = pos + 1;
					var transStatus = data.substr(pos, 1);
					var transData = data.substr(pos2);				
					
					if(transStatus == 1){
						$("#statuss").removeClass("error");
						$("#statuss").addClass("success");
						$("#statuss").fadeIn();
						document.getElementById("statuss").innerHTML = transData;											
					}else if(transStatus == 2){
						document.getElementById("login_email").value = '';
						$("#statuss").removeClass("success");
						$("#statuss").addClass("error");
						$("#statuss").fadeIn();
						document.getElementById("statuss").innerHTML = transData;															
					}
	    	}
  		}
	var url = "http://"+window.location.hostname;
		xmlhttp.open("GET", url+"/pages/email.php?email=" + email , true);
		xmlhttp.send();
}

function checkUsername(userName){
		var xmlhttp;
	
		if(userName == ''){
			$("#statusss").fadeOut();
		}
		if(window.XMLHttpRequest){
  			xmlhttp=new XMLHttpRequest();
	  	}else{
  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  	}
		
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				var data = xmlhttp.responseText;
				var index = data.search("T");
					var pos = index + 1;
					var pos2 = pos + 1;
					var transStatus = data.substr(pos, 1);
					var transData = data.substr(pos2);				
					
					if(transStatus == 1){
						$("#statusss").removeClass("error");
						$("#statusss").addClass("success");
						$("#statusss").fadeIn();
						document.getElementById("statusss").innerHTML = transData;
					}else if(transStatus == 2){
						document.getElementById("user_name").value = '';
						$("#statusss").removeClass("success");
						$("#statusss").addClass("error");
						$("#statusss").fadeIn();
						document.getElementById("statusss").innerHTML = transData;														
					}
	    	}
  		}
	var url = "http://"+window.location.hostname;
		xmlhttp.open("GET", url+"/pages/username.php?userName=" + userName , true);
		xmlhttp.send();
}

function comparePasswords(){
	
	var pass1 = $("#pass1").val();
	var pass2 = $("#pass2").val();
	
	if(pass1 != pass2){
		alert("Both passwords must be same.");
		document.getElementById("pass2").value = '';
	}
	
}

function hideStatuses(){
	$("#statuss").fadeOut();
	$("#statusss").fadeOut();
}

function getAdId(adId){
		var xmlhttp;
		if(adId == ''){
			$("#statusssss").fadeOut();
		}
		if(window.XMLHttpRequest){
  			xmlhttp=new XMLHttpRequest();
	  	}else{
  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  	}
		
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				var data = xmlhttp.responseText;
				var index = data.search("T");
					var pos = index + 1;
					var pos2 = pos + 1;
					var transStatus = data.substr(pos, 1);
					var transData = data.substr(pos2);				
					
					if(transStatus == 1){
						$("#statusssss").removeClass("error");
						$("#statusssss").addClass("success");
						$("#statusssss").fadeIn();
						document.getElementById("statusssss").innerHTML = transData;
					}else if(transStatus == 2){
						document.getElementById("ad_id").value = '';
						$("#statusssss").removeClass("success");
						$("#statusssss").addClass("error");
						$("#statusssss").fadeIn();
						document.getElementById("statusssss").innerHTML = transData;														
					}
	    	}
  		}
	var url = "http://"+window.location.hostname;
		xmlhttp.open("GET", url+"/pages/adid.php?adId=" + adId , true);
		xmlhttp.send();
}

function changeLocation(){
	$("#check1").css("display", "block").css("z-index", "777");	
}
function cancelChange(divId){
	$("#" + divId).fadeOut();	
}

function changeCategories(){
	$("#check_categories").css("display", "block").css("z-index", "777");	
}

function getStateAndCities(domainId, divId, whatData){
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
  	}else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}

	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			var data = xmlhttp.responseText;
			document.getElementById(divId).innerHTML = data;
    	}
	}
        var url = "http://"+window.location.hostname;
	xmlhttp.open("GET", url+"/includes/adlocations.php?domainId=" + domainId + "&req=" + whatData, true);
	xmlhttp.send();
}

function getStateAndCitiesMenu(domainId, divId, whatData){
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
  	}else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}

	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			var data = xmlhttp.responseText;
			document.getElementById(divId).innerHTML = data;
    	}
	}
        var url = "http://"+window.location.hostname;
	xmlhttp.open("GET", url+"/includes/menu_states_cities.php?domainId=" + domainId + "&req=" + whatData, true);
	xmlhttp.send();
}
function getStateAndCities2(domainId, divId, whatData, nameState){
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
  	}else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}

	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			var data = xmlhttp.responseText;
                        //$("#stateName").val(nameState);
                        document.getElementById("stateName").innerHTML = nameState;
			document.getElementById(divId).innerHTML = data;
    	}
	}
        var url = "http://"+window.location.hostname;
	xmlhttp.open("GET", url+"/includes/adlocations.php?domainId=" + domainId + "&req=" + whatData, true);
	xmlhttp.send();
}
function getLocations(id, location){
	var text_script = "<script>getLocations(<?php echo $_SESSION['domainId']  ?>, 'mainLocation'); addr = document.getElementById('cityLoc').options[document.getElementById('cityLoc').selectedIndex].text + ', ' + document.getElementById('state').options[document.getElementById('state').selectedIndex].text + ', ' + '<?php echo $countryName; ?>';codeAddress(addr);} else{"+ 
                        "$('#mainLocation').empty(); "+
                        "$('#mainLocOther').empty(); "+
                        "$('#mainCat').empty(); "+
                        "$('#childCat').empty();"+
                        "$('#mainCatOther').empty(); "+
                        "$('#subCatOther').empty(); "+
                        "$('#getcat').fadeOut(); }</script>";
	var location = location;
	var id = id;
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
  	}else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}

	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			var data = xmlhttp.responseText;
			
                        if(location=='cityLocation'){
                            document.getElementById(location).innerHTML = data+text_script;
                        }else{
                            
                            document.getElementById(location).innerHTML = data;
                        }
    	}
	}
	var url = "http://"+window.location.hostname;
	xmlhttp.open("GET", url+"/includes/locations.php?id=" + id + "&location=" + location, true);
	xmlhttp.send();
}

function getLocationsWithCN(id, location, countryName){
    
	var text_script = "<script>getLocations(<?php echo $_SESSION['domainId']  ?>, 'mainLocation'); addr = document.getElementById('cityLoc').options[document.getElementById('cityLoc').selectedIndex].text + ', ' + document.getElementById('state').options[document.getElementById('state').selectedIndex].text + ', ' + '"+countryName+"';codeAddress(addr);} else{"+ 
                        "$('#mainLocation').empty(); "+
                        "$('#mainLocOther').empty(); "+
                        "$('#mainCat').empty(); "+
                        "$('#childCat').empty();"+
                        "$('#mainCatOther').empty(); "+
                        "$('#subCatOther').empty(); "+
                        "$('#getcat').fadeOut(); }</script>";
	var location = location;
	var id = id;
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
  	}else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}

	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			var data = xmlhttp.responseText;
			
                        if(location=='cityLocation'){
                            document.getElementById(location).innerHTML = data+text_script;
                        }else{
                            document.getElementById(location).innerHTML = data;
                        }
    	}
	}
	var url = "http://"+window.location.hostname;	
	xmlhttp.open("GET", url+"/includes/locations.php?id=" + id + "&location=" + location, true);
	xmlhttp.send();
}

function loading_show() {
        $('#loading').html("<img src='../images/loading.gif'/>").fadeIn('fast');
    }
    function loading_hide() {
        $('#loading').fadeOut('fast');
    }
    function loadData(page) {
        
        loading_show();
        
        var stateid = $("#stateids").val();
    
        $.ajax
                ({
                    type: "GET",
                    url: "http://" + window.location.host + "/includes/show_cities.php",
                    data: {stateId: stateid, page: page},
                    success: function(msg)
                    {
                        $(document ).ajaxComplete(function(event, request, settings)
                        {
                            loading_hide();
                           // alert(msg);
                            $("#allCatAccLoc").html(msg);
//                             $("#comment").html("");
//                              $("#author").val("Username");
                        });
                    },
                    error: function(jqXHR, textStatus) {
                        alert("eeor" + jqXHR.data + "/" + textStatus);
                    }
                });
    }
    
    function loadDataAds(page) {
        
        loading_show();
        
        //var stateid = $("#stateids").val();
        var ads_level=$("#ads_level").val();
        var country_id=$("#country_id").val();
        var state_id=$("#state_id").val();
        var city_id=$("#city_id").val();
        var domain_id=$("#domain_id").val();
        var main_id=$("#main_id").val();
        var sub_id=$("#sub_id").val();
        var main_loc_id=$("#main_loc_id").val();
        var search_text=$("#search_text").val();
        
        $.ajax
                ({
                    type: "GET",
                    url: "http://" + window.location.host + "/includes/show_ads_list.php",
                    data: {level: ads_level,countryId :country_id, stateId :state_id,
                        cityId :city_id,domainId :domain_id,mainId : main_id,
                        subId :sub_id ,loc_id : main_loc_id,search_text : search_text,page: page},
                    success: function(msg)
                    {
                        $(document ).ajaxComplete(function(event, request, settings)
                        {
                            loading_hide();
                            var tab = msg.split("###");
                            
                            //alert(msg);
                            $("#show_ads").html(tab[0]);
                            $("#datamap").val(tab[1]);
                            setLocationmap();
//                             $("#comment").html("");
//                              $("#author").val("Username");
                        });
                    },
                    error: function(jqXHR, textStatus) {
                        alert("eeor" + jqXHR.data + "/" + textStatus);
                    }
                });
    }
$(document).ready(function(){
       
        $(document).on("click", '#allCatAccLoc .pagenav li.active', function() {
       
        var page = $(this).attr('p');
        loadData(page);
    });
       $(document).on("click", '#show_ads .pagenav li.active2', function() {
       
        var page = $(this).attr('p');
        loadDataAds(page);
    });
   })
   
   function setLocationmap() {
           
            //list = "<?php echo str_replace('"','\'',$datamap); ?>";
           
            list = $("#datamap").val();
            var latLng = new google.maps.LatLng(0, 0);
            map = new google.maps.Map(document.getElementById('map-canvas'), {
                zoom: 1,
                center: latLng,
                maxZoom: 20,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var tab = list.split('#*#');
            for (i = 0; i < tab.length; i++) {
                initialize(tab[i], map);
                //break;
            }
            var infowindow = new google.maps.InfoWindow();
          var clusterOptions = { zoomOnClick: false };
           
            var markerCluster = new MarkerClusterer(map,markers,clusterOptions);
            google.maps.event.addListener(markerCluster, 'clusterclick', function (mCluster) {
                var marks = mCluster.getMarkers();
                var boxText = document.createElement("div");
                boxText.setAttribute("style","overflow-y: scroll; height:400px;");
                var title="";
                for(var m in marks){
                   
                    title += "<a href='pages/ads-"+marks[m].id+"-"+ marks[m].stitle +".html'>"+"&raquo;"+marks[m].title+"</a><br>";
                    
                }
                
                boxText.style.cssText = "background-color:#5B8B14; border:1px solid #5B8B14; color:#FFF !important; text-decoration:none; margin:0; padding:5px 10px; -khtml-border-radius: 4px; -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px; text-shadow:1px 1px 0 rgba(0, 0, 0, 0.25)";
            boxText.innerHTML = "<b>" + title + " <br />&raquo; <a target='_blank' style='color: #FFFFFF;' href='http://www.adbck.com/' title='ADBCK Classified <?php echo $_SESSION['domainName']; ?> -Ads for you...'><?php echo $_SESSION['domainName']; ?> -Ads for you...</a></b>";
                 var info = new google.maps.MVCObject;
                info.set('position', mCluster.center_);
                infowindow.close();
                infowindow.setContent(boxText);
                infowindow.setPosition(mCluster.center_);
                infowindow.open(map,info);
            });
          
            $('.map-canvas').css({height: 'auto', width: 'auto'});

        }
        
        function initialize(latitude, map) {
            if (latitude == "")
                return;
            if (typeof (latitude) == "undefined") {
                //alert(latitude);
                return;
            }

            var title = latitude.split('***')[0];
            var cordonne = latitude.split('***')[1];
            var id = latitude.split('***')[2];
            var stitle = latitude.split('***')[3];
            // alert("cordonne="+cordonne);
            if (typeof (cordonne) == "undefined") {
                // alert(latitude);
                return;
            }
            if (cordonne.split('*').length == 0)
                return;
            var lat = cordonne.split('::')[0];
            var lng = cordonne.split('::')[1];
            var latLng = new google.maps.LatLng(lat, lng);

            var marker = new google.maps.Marker({
                position: latLng,
            title: title,
            id : id,
            stitle : stitle
            
//           // icon: 'fav.ico',
//            map: map,
//            center: latLng,
//            draggable: false
            });
            //  map.setCenter(latLng);
            var contennt = new google.maps.InfoWindow({
                content: 'this'
            });
            var boxText = document.createElement("div");
            boxText.style.cssText = "background-color:#5B8B14; border:1px solid #5B8B14; color:#FFF !important; \n\
            text-decoration:none; margin:0; padding:5px 10px; -khtml-border-radius: 4px; -moz-border-radius: 4px;\n\
            -webkit-border-radius: 4px; border-radius: 4px; text-shadow:1px 1px 0 rgba(0, 0, 0, 0.25)";
            boxText.innerHTML = "<a href='pages/ads-"+id+"-" +stitle+"' ><b>&raquo; " + title + "</a> <br />&raquo; <a target='_blank' style='color: #FFFFFF;' href='http://www.adbck.com/' title='ADBCK Classified <?php echo $_SESSION['domainName']; ?> -Ads for you...'><?php echo $_SESSION['domainName']; ?> -Ads for you...</a></b>";
            var infowindow = new google.maps.InfoWindow({content: boxText});
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map, marker);
            });
            markers.push(marker);
        }