<h3>Aktuální stav restaurace</h3>


<hr>

<script type="text/javascript">

    var bookableIframeSrcBase = window.location.href + '/order-bookable/';

    // Javascript iframe fitter
    function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    }

    // Temporary location -> should be moved somewhere else
    $(document).ready(function(){
       // Get all seats with ID and attach an event handler
        var seats = $(".seat").toArray();
        seats.forEach(function (seat){
            if (seat.hasAttribute("id"))
            {
                console.log("Found seat with id=" + seat.id + "... attaching event listener.");
                seat.addEventListener("click", function(){
                    console.log("Opening dialog for seat with ID=" + seat.id + "!");

                    // Close possible previously opened dialogs
                    $(".ui-dialog-content").dialog("close");
                    // Remove previously appended iframes
                    $("#dialog").empty();

                    // Acquire setting values for jQuery UI dialog
                    var windowWidth = $(window).width();
                    var windowHeight = $(window).height();

                    // Handle the dialog opening
                    // Append <iframe> with desired page from our backend
                    $("#dialog").append($("<iframe onload=\"resizeIframe(this)\" scrolling=\"no\" class=\"seemless\" />").attr("src", bookableIframeSrcBase + seat.id)).dialog({
                        modal: true,
                        width: (windowWidth * 0.8),
                        height: (windowHeight * 0.8)
                    })
                })
            }

        });

        var saloon = $(".room-saloon")[0];
        if (saloon.hasAttribute("id"))
        {
            console.log("Saloon found with id=" + saloon.id + "...attaching event listener.");
            saloon.addEventListener("click", function(){
                console.log("Opening dialog for saloon with ID=" + saloon.id + "!");

                $(".ui-dialog-content").dialog("close");
                var windowWidth = $(window).width();
                var windowHeight = $(window).height();
                $("#dialog").empty().append($("<iframe onload=\"resizeIframe(this)\" scrolling=\"no\" class=\"seemless\" />").attr("src", bookableIframeSrcBase + saloon.id)).dialog({
                    modal: true,
                    width: (windowWidth * 0.8),
                    height: (windowHeight * 0.8)
                })
            })
        }

        var tables = $(".room-table").toArray();
        tables.forEach(function (table){
            console.log("Found a table with id=" + table.id + "... attaching event listener");
            table.addEventListener("click", function(){
                $(".ui-dialog-content").dialog("close");
                $("#dialog").empty();
                var windowWidth = $(window).width();
                var windowHeight = $(window).height();
                $("#dialog").append($("<iframe onload=\"resizeIframe(this)\" scrolling=\"no\" class=\"seemless\" />").attr("src", bookableIframeSrcBase + table.id)).dialog({
                    modal: true,
                    width: (windowWidth * 0.8),
                    height: (windowHeight * 0.8)
                })});
        });

        // More on-load code

        // Add order flag class to bookables that has order on it
        var orderFlags = {!! $orderFlags !!} ;
        for (var i = 0; i < orderFlags.length; i++)
        {
            $("#" + orderFlags[i]).addClass('hasOrder');
        }

    });
</script>

<div id="dialog">

</div>

<div class="info">
    Kliknutím na jednotku zobrazíte její aktuální objednávky nebo přidáte položky do objednávky, případně vytvoříte objednávku novou.
    <br>
    Položky patřící k jednotlivým židlím je možné vidět i souhrnně u stolu, ke kterému židle patří.
    <br>
    Objednávky lze platit odděleně po židlích a nebo zaplatit celý stůl.
</div>

<table class="room-plan">

    <thead>
    <tr>
        <th>ww</th>	<th>ww</th>	<th>ww</th>	<th>ww</th>	<th>ww</th>
        <th>ww</th>	<th>ww</th>	<th>ww</th>	<th>ww</th>	<th>ww</th>
        <th>ww</th>	<th>ww</th>	<th>ww</th>	<th>ww</th>	<th>ww</th>
        <th>ww</th>	<th>ww</th>	<th>ww</th>	<th>ww</th>	<th>ww</th>
        <th>ww</th>	<th>ww</th>	<th>ww</th>	<th>ww</th>	<th>ww</th>
        <th>ww</th>	<th>ww</th>	<th>ww</th>
    </tr>
    </thead>

    <tr> <!-- 1 -->
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 2 -->
        <td>_</td>	<td class="seat" id="1">O</td>	<td>_</td>	<td class="seat" id="2">O</td>	<td>_</td>
        <td class="seat" id="3">O</td>	<td>_</td>	<td class="seat" id="4">O</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td class="seat" id="5">O</td>	<td>_</td>	<td class="seat" id="6">O</td>	<td>_</td>
        <td class="seat" id="7">O</td>	<td>_</td>	<td class="seat" id="8">O</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td class="seat" id="9">O</td>	<td>_</td>	<td class="seat" id="10">O</td>	<td>_</td>
        <td class="seat" id="11">O</td>	<td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 3 -->
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 4 -->
        <td>_</td>	<td  class="seat" id="12">O</td>	<td>_</td>	<td  class="room-table" id="43" colspan="3" rowspan="3">Stůl 1</td>	<td>_</td>	<td class="seat" id="13">O</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td  class="seat" id="14">O</td>	<td>_</td>	<td  class="room-table" id="44" colspan="3" rowspan="3">Stůl 2</td>
        <td>_</td>	<td class="seat" id="15">O</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td class="room-table" id="45" colspan="5" rowspan="2">Stůl 3</td>	<td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 5 -->
        <td>_</td>	<td>_</td>	<td>_</td>   <td>_</td>	<td>O</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 6 -->
        <td>_</td>	<td class="seat" id="16">O</td>	<td>_</td>	<td>_</td>	<td class="seat" id="17">O</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td class="seat" id="18">O</td>	<td>_</td>	<td>_</td>	<td class="seat" id="19">O</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 7 -->
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td class="seat" id="20">O</td>	<td>_</td>	<td class="seat" id="21">O</td>	<td>_</td>
        <td class="seat" id="22">O</td>	<td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 8 -->
        <td>_</td>	<td class="seat" id="23">O</td>	<td>_</td>	<td  class="seat" id="24">O</td>	<td>_</td>
        <td class="seat" id="25">O</td>	<td>_</td>	<td class="seat" id="26">O</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td class="seat" id="27">O</td>	<td>_</td>	<td class="seat" id="28">O</td>	<td>_</td>
        <td class="seat" id="29">O</td>	<td>_</td>	<td class="seat" id="30">O</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 9 -->
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 10 -->
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 11 -->
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td class="room-saloon" id="50" rowspan="11" colspan="11">Salónek</td>
    </tr>

    <tr> <!-- 12 -->
        <td>_</td>	<td class="seat" id="31">O</td>	<td>_</td>	<td class="room-table" id="46" rowspan="3" colspan="2">Stůl 4</td>	<td>_</td>	<td class="seat" id="32">O</td>	<td>_</td>	<td>_</td>	<td class="seat" id="33">O</td>
        <td>_</td>	<td class="room-table" id="47" rowspan="3" colspan="2">Stůl 5</td>	<td>_</td>	<td class="seat" id="34">O</td>
        <td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 13 -->
        <td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 14 -->
        <td>_</td>	<td class="seat" id="35">O</td>	<td>_</td>
        <td>_</td>	<td class="seat" id="36">O</td>	<td>_</td>	<td>_</td>	<td class="seat" id="37">O</td>
        <td>_</td>	<td>_</td>	<td class="seat" id="38">O</td>
        <td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 15 -->
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 16 -->
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 17 -->
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 18 -->
        <td>_</td>	<td>_</td>	<td>_</td>	<td class="room-table" id="48" rowspan="3" colspan="2">Stůl 6</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td class="room-table" id="49" rowspan="3" colspan="2">Stůl 7</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 19 -->
        <td>_</td>	<td class="seat" id="39">O</td>	<td>_</td>
        <td>_</td>	<td class="seat" id="40">O</td>	<td>_</td>	<td>_</td>	<td class="seat" id="41">O</td>
        <td>_</td>	<td>_</td>	<td class="seat" id="42">O</td>
        <td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 20 -->
        <td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 21 -->
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>
    </tr>
</table>
