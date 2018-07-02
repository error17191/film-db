function showTooltip() {
    alert('دة عدد البلاغات يا معلم');
}

function ignoreFilm(uid,btn){
    btn.setAttribute('disabled',true);
    axios.post('ignore.php',{uid: uid}).then(function (response){
        if(response.data.success){
            document.getElementById('uid-'+uid).remove();
        }
    });
}

function removeFilm(uid,btn){
    btn.setAttribute('disabled',true);
    axios.post('remove.php',{uid: uid}).then(function (response){
        if(response.data.success){
            document.getElementById('uid-'+uid).remove();
        }
    });
}