$(document).ready(
    function(){
        var a=function(){
            var a=$("#myTabExample > li"),
                b=a.filter(".active")
                ,c=b.next("li").length?b.next("li").find("a"):a.filter(":first-child").find("a");
            c.tab("show")
        },
            b=setInterval(a,5e3);

$(this).find("#myTabExample a").click(
    function(c){
        c.preventDefault();clearInterval(b);$(this).tab("show");
        setTimeout(
            function(){
            b=setInterval(a,5e3)
            },2e4)
    })});