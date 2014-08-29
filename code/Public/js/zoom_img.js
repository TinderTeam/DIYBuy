    function resizepic(thispic){
        if((thispic.width/thispic.height)>(3/2)) thispic.width='200';
        if((thispic.width/thispic.height)<(3/2)) thispic.height='121';
    } 
function addBookmark(title,url) {
if (window.sidebar) { 
window.sidebar.addPanel(title, url,""); 
} else if( document.all ) {
window.external.AddFavorite( url, title);
} else if( window.opera && window.print ) {
return true;
}
}