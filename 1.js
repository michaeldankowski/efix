$(function (){
    var count = 60*10; // ustawienie licznika na 60 sekund
    var counter = setInterval(timer, 1000); // ustawienie funkcji odpowiedajacej za cykliczne wywolanie(co 1 s) funkcji timer()
    function timer()
    {
        --count;
        var minutes = Math.floor(count / 60); // obliczanie ile minut zostało
        var sec = count % 60; //obliczanie ile sekund zostało reszta z dzielenia licznika przez 60 sekund
        if(sec<10) sec = '0' + sec; // jeżeli mniej niż 10 sekund to wyświetl sekundy w formacie 00 zamiast 0  
        var out = "Automatyczne wylogowanie za " + minutes + ':' + sec; //tekst wyswietlony uzytkownikowi
        $("#timer").html(out); // przypisanie tekstu timera do odpowiedniego elementu html
        if( count <= 0) //licznik osiągnął 0 
        {
            //licznik się wyzerował należy podjąć odpowiednią akcje
            clearInterval(counter); //zatrzymanie licznika
            return; 
        }
    }
});