$(document).ready( function include()
{
    var reURL = /(([^:]+:)\/{1,2}[^\/]*)(.*?)$/;
    var m = reURL.exec(document.URL);
    if (m)
    { 
       var rootURL = m[1]+"/";
       $("script").each(function findSelf()
       {
           if (this.src)
           {
               var base = this.src.indexOf("include-script.js");
               if (base != -1)
                   rootURL = this.src.substr(0, base);
           }
       });
      
       $("#header").load(rootURL+"include-header.html", null, rewriteWhenPartnerDone);
       $(".footer").load(rootURL+"include-footer.html", null, rewriteWhenPartnerDone);
       
    }
});

var rewritePartnerDone = false;

function rewriteWhenPartnerDone()
{
    if (rewritePartnerDone)
        rewriteURLs(getRootURLForRewrite());
    else
        rewritePartnerDone = true;
}

function getRootURLForRewrite()
{
    var rootURL = document.URL;
    $("script").each(function findSelf()
    {
        if (this.src)
        {
            var base = this.src.indexOf("include-script.js");
            if (base != -1)
                rootURL = this.src.substr(0, base);
        }
    });
    return rootURL;
}

function rewriteURLs(rootURL)
{
    $(".rootRelative").each( function addRoot()
    {
        if (this.href)
            this.href = absoluteFromRoot(this.href, rootURL);
        else if (this.src)
            this.src = absoluteFromRoot(this.src, rootURL);
    });
}

function absoluteFromRoot(url, rootURL)
{
     var parts = url.split('/');
     return rootURL + parts[parts.length - 1];
}