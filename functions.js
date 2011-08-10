/*
---
description: Live search class that works on li and tr elements, recognizes up, down, enter, click commands.

license: MIT-style

authors:
- Troy Wolfe

requires:
- core: 1.2.4/Event
- core: 1.2.4/Class
- core: 1.2.4/Class.Extras
- core: 1.2.4/Element
- core: 1.2.4/Element.Event
- core: 1.2.4/Element.Style
- core: 1.2.4/DomReady

provides: [LLSearch]

...
*/

/*!
Live List Search for Mootools 1.2
copyright 2009 Troy Wolfe
*/

var LLSearch = new Class ({
	Implements: [Options, Events],
	options: {
		inputID: '', // the id of the live search input field
		listID: '', // the id of the ul, ol or table
		inResultsClass: 'LLS_inresults', 
		listType: 'li', // accepts li or tr
		preventClick: true,
		reFocus: true,
		currentSelection: 'LLS_current_selection', // the class of the current selection (should i make this ID?) 
		searchTerm: '', // class of element to search within tr, only used if listType == 'tr'
		searchTermLi: ''
		/*onEnter: $empty*/
		/*onClick: $empty*/
	},
	initialize: function(options) {		
		this.setOptions(options);
		this.inputName = $(this.options.inputID);
		
		this.inputName.addEvent('keyup', function(){
		    this.filterList();
		}.bind(this));
		
		if (this.options.listType == 'tr') 
		{
			this.searchElements = $$('#' + this.options.listID + ' > ' + 'tbody > ' + this.options.listType);
		}
		else {
			this.searchElements = $$('#' + this.options.listID + ' ' + this.options.listType);
		}
		
		this.searchStrings = new Array;
		
		this.searchElements.each(function(el, index){
			var text =  el.get("text").toLowerCase();
		
			//get rid of "inschrijven"
			this.searchStrings[index] = text.substring(0, text.length - 12)
			
		}.bind(this));
							
		this.currentLiveSearch= '';
		this.searchEvents = [];
		this.filterList();	
	}, 
	
	getInputValue: function(){
		this.searchEvents.currentText = this.inputName.get('value').toLowerCase();
	},
	
	filterList: function(){
		this.getInputValue();

		this.searchStrings.each(function(string, index){
			if(index == 0) return;
			
			if(string == "" || string.contains(this.searchEvents.currentText)) {				
				var el = this.searchElements[index];
				
				if (this.options.listType == 'tr' && el) {
					el.setStyle("display","");
				}
				else {
					el.setStyle("display","block");
				}		
						
			} else {			
				var el = this.searchElements[index];
				el.setStyle("display","none");
			}

		}.bind(this));
		
	}
});

//FUNCTIONS
function laadstudie()
{
if($("studies").value && $("studies").value != "")
{

	$('loading').setStyle('display', 'block');
	$("studies").setAttribute('disabled', true);
	$("inschrijvingen").setStyle('opacity', 0.5);
	$$("#inschrijvingen td a").destroy();
	
	var myRequest = new Request({url: 'vakken.php', method: 'get', onSuccess: function(responseText, responseXML) {
		$("inschrijvingen").set('html',responseText);
		$('loading').setStyle('display', 'none');
		$("studies").removeAttribute('disabled');
		$("inschrijvingen").setStyle('opacity', 1.0);
		
		searchTags = new LLSearch({
		    'inputID' : 'list_search',                  
		    'listID' : 'inschrijvingen',
		    'listType' : 'tr',
		    'searchTerm' : 'title'
		});
		$("search_rows").setStyle('display', 'block');
//		
	}}).send('q='+$("studies").value);
	
}	
}

function display(element)
{
	var el = $(element);
	$("inschrijving").setStyle('display', 'block');
	$("inschrijving").set('html', el.innerHTML);
	
	
	$("background").setStyle('display', 'block');
	
	$("inschrijving").setStyle('top', window.getScroll().y+100);
		
	$("background").setStyle('position', 'absolute');
	$("background").setStyle('height', window.getScrollHeight());
	$("background").setStyle('width', window.getScrollWidth());	
	
	$("studies").setStyle('visibility', 'hidden');
}

function hide()
{
	$("inschrijving").setStyle('display', 'none');
	$("inschrijving").set('html',"");
	$("background").setStyle('display', 'none');
	
	$("studies").setStyle('visibility', 'visible');
}

function laadonderdelen(element)
{	
	$$('#inschrijving .link').setStyle('display', 'none');
	$$('#inschrijving .loading').setStyle('display', 'block');
	$$("#inschrijving td a").destroy();
	
	$('loading').setStyle('display', 'block');
	$("studies").setAttribute('disabled', true);
	$("inschrijvingen").setStyle('opacity', 0.5);
	
	var myRequest = new Request({url: 'alleonderdelen.php', method: 'get', onSuccess: function(responseText, responseXML) {
		$("inschrijvingen").set('html',responseText);
		$('loading').setStyle('display', 'none');
		$("studies").removeAttribute('disabled');
		$("inschrijvingen").setStyle('opacity', 1.0);
		
		$("inschrijving").set("html", $$("td.geselecteerd").clone()[0].get("html"));
		
		searchTags = new LLSearch({
		    'inputID' : 'list_search',                  
		    'listID' : 'inschrijvingen',
		    'listType' : 'tr',
		    'searchTerm' : 'title'
		});
		$("search_rows").setStyle('display', 'block');
		

		$("background").setStyle('height', window.getScrollHeight());
		$("background").setStyle('width', window.getScrollWidth());			
	}}).send('q='+element);
	
}

function inschrijven(vakbeschrijving, element)
{	
	$$("#inschrijving ."+element+" td").setStyle("background-color", "green");
	$$("#inschrijving ."+element+" td").setStyle("color", "white");
	
	$$("#inschrijving td a").destroy();	
	$$('#inschrijving .loadinginschrijving').setStyle('display', 'block');
	
	$("inschrijvingen").setStyle('opacity', 0.5);
	
	var myRequest = new Request({url: 'inschrijven.php', method: 'get', onSuccess: function(responseText, responseXML) {
		$$('#inschrijving .inschrijving').set('html',responseText);
		$$('#inschrijving .loadinginschrijving').setStyle('display', 'none');
		$$("#inschrijving td a").setStyle("display", "block");
		
		
		reload();
	}}).send('studie='+$("studies").value+"&q="+vakbeschrijving);
}

function displayUitschrijven()
{
	var rows = new Array;
	
	var div = new Element('div', {});
	
	var title = new Element('h2', {
	    html: 'Uitschrijven?'
	});
	
	title.inject(div);
	
	var table = new Element('table', {
	    border: '0',
	    cellspacing: '0',
	    cellpadding: '0'
	});
	
	var oneChecked = false;
	
	$$("#inschrijvingen_table tr").each(function(el, index){
		if(index == 0){
			el.clone().inject(table);
		}
		
		var input = el.getElement('input'); 
		
		if(input && input.checked)
		{			
			var element = $(input.getParent("tr")).clone();
			element.inject(table);
						
			oneChecked = true;
		}
	});
	
	if(!oneChecked) return;
	
	var sluitlink = new Element('a', {
	    html:"sluit",
	    href:"#!",
	    onclick:"hide()",
	    styles: {
	    	"display":"block",
	    	"text-align":"right"
	    }
	});
	
	var uitschrijvenButton = new Element('a', {
	    html:"Uitschrijven",
	   	href:"#!",
	    onclick:"uitschrijven()",
	    'class':'uitschrijven_link',
	    styles: {
	    	"display":"block",
	    	"padding-bottom":"1em"
	    }
	});
	
	table.inject(div);
	uitschrijvenButton.inject(div);
	sluitlink.inject(div);
			
	display(div);
	
	//enabled false, want nog niet gebouwd.
	$("inschrijving").getElements("input").each(function(el){ el.setStyle('display', 'none'); el.checked = true; });
}

function reload()
{
	
	if($("studies").value && $("studies").value != "")
	{
	
		$('loading').setStyle('display', 'block');
		$("studies").setAttribute('disabled', true);
		$("inschrijvingen").setStyle('opacity', 0.5);
		$$("#inschrijvingen td a").destroy();
	}
	
	
	
	$("inschrijvingen_table").setStyle('opacity', 0.5);
	$$("#inschrijvingen_table input").destroy();
	
	var image = new Element('img', {
		src : "ajax-loader.gif",
		styles: {
			'top':'6px',
			'position':'relative'
		}
	});		 
	
	var text = new Element('span', {
	    html:"Inschrijvingen laden +/- 5 secondes"
	});
	

	text.inject("vakken_uitschrijven_link");	
	image.inject("vakken_uitschrijven_link");
	
	$$("#vakken_uitschrijven_link a").destroy();
	
	var myRequest = new Request({url: 'inschrijvingen_html.php', method: 'get', onSuccess: function(responseText, responseXML) {
		$("inschrijvingen_table").set('html', responseText);
		$("inschrijvingen_table").setStyle('opacity', 1.0);
		
		var inschrijvenlink = new Element('a', {
		    html:"Geselecteerde vakken uitschrijven",
		    href:"#!",
		    events: {
		         click: function(){
		             displayUitschrijven();
		         }
		    }
		});
		
		text.destroy();
		image.destroy();
		inschrijvenlink.inject("vakken_uitschrijven_link");
		
		if($("studies").value && $("studies").value != ""){
		
			var myRequest = new Request({url: 'vakken.php', method: 'get', onSuccess: function(responseText, responseXML) {
				$("inschrijvingen").set('html',responseText);
				$('loading').setStyle('display', 'none');
				$("studies").removeAttribute('disabled');
				$("inschrijvingen").setStyle('opacity', 1.0);
				
				searchTags = new LLSearch({
				    'inputID' : 'list_search',                  
				    'listID' : 'inschrijvingen',
				    'listType' : 'tr',
				    'searchTerm' : 'title'
				});
				$("search_rows").setStyle('display', 'block');
		//		
			}}).send('q='+$("studies").value);
			
		}
		
	}}).send();	
}

function uitschrijven()
{
	//niet erg blij over deze functie....

	var string="";	
	$$("#inschrijving tr").each(function(el, index){
		var input = el.getElement('input'); 
		
		if(input && input.checked)
		{
			string += input.name+",";			
		}
	});
	
	var image = new Element('img', {
		src : "ajax-loader.gif",
		styles: {
			'top':'6px',
			'position':'relative'
		}
	});		 
	
	var text = new Element('span', {
	    html:"Uitschrijven +/- 5 secondes"
	});
	
	$$("#inschrijving tr input").destroy();
	$$("#inschrijving a").destroy();

	text.inject("inschrijving");	
	image.inject("inschrijving");
	
	var sluitlink = new Element('a', {
	    html:"sluit",
	    href:"#!",
	    events: {
	         click: function(){
	             hide();
	         }
	    },
	    styles: {
	    	"display":"block",
	    	"text-align":"right"
	    }
	});
				
	var jsonRequest = new Request({
		url: 'uitschrijven.php', 
		method: 'get',
		onSuccess: function(responseText){
		
			var myObject = eval('(' + responseText + ')');
			var arr = $A(myObject['respons']);						
			
	    	$$("#inschrijving tr").each(function(ele, index){
		    			    
		    	if(index != 0)
		    	{
			    	var el = ele.getChildren("td")[0];
		    		
		    		var html = "";
		    		if(typeOf(arr) == "array")
		    		{
		    			html = el.get("html") + "<br /><br />" + arr[index-1];
		    		} else {
		    			html = el.get("html") + "<br /><br />" + arr;
		    		}
		    		
	    			el.set("html",html);
	    		}
	    	
	    	});
	    	
	    	image.destroy();
	    	text.destroy();
	    	
	    	sluitlink.inject("inschrijving");
	    	
	    	reload();
		}
	}).send("q="+string);		
}