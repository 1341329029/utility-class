function  printExcel(obj)  
{  
    var xlsApp = null;      
    try{          
       xlsApp = new ActiveXObject('Excel.Application');    }catch(e)   
    {   
        alert(e+', 原因分析: 浏览器安全级别较高导致不能创建Excel对象或者客户端没有安装Excel软件');
          return;   
    }      
    //var xlBook = xlsApp.Workbooks.Open('http://'+window.location.host+obj.value);  
    var xlBook = xlsApp.Workbooks.Open(obj);  
    var xlsheet = xlBook.Worksheets(1);  
    xlsApp.Application.Visible = false;   
    xlsApp.visible = false;   
    xlsheet.Printout;   
    xlsApp.Quit();   
    xlsApp=null;
}  
function  openExcel(obj)  
{  
  // var xlsApp = null;  
    //try{  
    //    xlsApp = new ActiveXObject('Excel.Application');    }catch(e)  
    //{  
    //    alert(e+', 原因分析: 浏览器安全级别较高导致不能创建Excel对象或者客户端没有安装Excel软件');  
   //      return;  
   // }  
   //var s='http://'+window.location.host+obj.replace(/(file:\/\/)/g,'/report/');  
   //var xlBook = xlsApp.Workbooks.Open(s);  
   //xlsApp.Application.Visible = true;  
   //xlsApp.visible = true;  
   var s=obj.replace(/(file:\/\/)/g,'/report/');  
   window.showModalDialog('/ocx/attachshow.jsp?xlsName='+s,'报表预览','dialogWidth=1024px;dialogHeight=800px;status=no;help=no;scroll=no;location=no');  
}  
  
function  printExcels(obj)  
{  
     var xlsApp = null;      
     try {          
     xlsApp = new ActiveXObject('Excel.Application');    
     } catch(e) {   
     	alert(e+', 原因分析: 浏览器安全级别较高导致不能创建Excel对象或者客户端没有安装Excel软件');   
     	return;   
     }
     var s='http://'+window.location.host+obj.replace(/(file:\/\/)/g,'/report/');  
     var ss = s.split("/");  
     if(!(setFlag(ss[ss.length-2])))  
          return;  
     var xlBook = xlsApp.Workbooks.Open(s);  
       
          //var xlsheet;  
       
          try{
           
             //for(printSheetLen=1;printSheetLen<=xlBook.Sheets.Count;printSheetLen++){  
             
              //      xlsheet = xlBook.Worksheets(printSheetLen);   
       
         //    xlsApp.Application.Visible = false;   
      
              //  xlsApp.visible = false;   
                
               // xlsheet.Printout;   
        
               //}  
       
               xlBook.Printout;  
          }  
       
          catch(e){  
            
               alert(e);  
      
          }  
     finally{  
         xlsApp.Quit();   
         xlsApp=null;   
     //     clearPrintFlag();  
     }
}

function  printWord(obj)  
{
    var wordApp = null;
    try{
       wordApp = new ActiveXObject('Word.Application');
       var Doc=wordApp.Documents.Open(obj);
        wordApp.Application.Visible = false;
        wordApp.visible = false;   
        wordApp.ActiveDocument.printout();   
        wordApp.ActiveDocument.close();   
        wordApp.Quit();   
        wordApp=null;
    } catch(e) {
	    alert(e+', 原因分析: 浏览器安全级别较高导致不能创建Word对象或者客户端没有安装Word软件');   
	    return false;
    }
    //var Doc=wordApp.Documents.Open('http://'+window.location.host+obj.value);  
    
    return true;
}
//pdf打印
function bulkpdfPrint(srcFile){
	var pdf = document.getElementById("createPDF");
	if (pdf != undefined && pdf != null) {//判断pdf对象是否存在，如果存在就删除该对象
		var parentNode = pdf.parentNode;
		parentNode.removeChild(pdf);
    }
	var p = document.createElement("object");
	p.id = "createPDF";
	p.classid = "CLSID:CA8A9780-280D-11CF-A24D-444553540000";
	p.width = 1;
	p.height = 1;
	p.src = srcFile;
	document.body.appendChild(p);
	p.printAll();
}











