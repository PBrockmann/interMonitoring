
        function basename (path, suffix) {
            // http://kevin.vanzonneveld.net
            // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
            // +   improved by: Ash Searle (http://hexmen.com/blog/)
            // +   improved by: Lincoln Ramsay
            // +   improved by: djmix
            // *     example 1: basename('/www/site/home.htm', '.htm');
            // *     returns 1: 'home'
         
            var b = path.replace(/^.*[\/\\]/g, '');
            
            if (typeof(suffix) == 'string' && b.substr(b.length-suffix.length) == suffix) {
                b = b.substr(0, b.length-suffix.length);
            }
            
            return b;
        }

        function popimage(img) {
                w=open('',img,'width=800,height=600,toolbar=no,scrollbars=no,resizable=no');
                w.document.write("<html lang='en'>\n");
                w.document.write("<head>\n");
		title=basename(img, '');
                w.document.write("<title>"+title+"</title>\n");
                w.document.write("<script type='text/javascript'>\n");
                w.document.write("\tfunction checksize() {\n\t\tif (document.images[0].complete) {\n\t\t\twindow.resizeTo(document.images[0].width,document.images[0].height+60);\n\t\t\twindow.focus();\n\t\t\t}\n\t\telse {\n\t\t\tsettimeout('checksize()',250)\n\t\t\t}\n\t}\n\t");
                w.document.write("<"+"/script>\n");
                w.document.write("</head>\n\n");
                w.document.write("<body onload='checksize()' topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>\n");
                w.document.write("<img src='"+img+"' border='0'/>\n");
                w.document.write("</body>\n");
                w.document.write("</html>\n");
                w.document.close();
        }
