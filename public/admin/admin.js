function showTooltip() {
    alert('دة عدد البلاغات يا معلم');
}

function ignoreFilm(uid){
    axios.post('ignore.php',{uid: uid}).then(function (response){
        if(response.data.success){
            document.getElementById('uid-'+uid).remove();
        }
    });
}

function removeFilm(uid){
    axios.post('remove.php',{uid: uid}).then(function (){

    });
}