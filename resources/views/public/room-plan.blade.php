<script>

    function updateSelectedHiddenField()
    {
        $(".disabled").removeClass("selected");

        var allSelected = document.getElementsByClassName("selected");
        var acc = [];
        for (var i = 0; i < allSelected.length; i++)
        {
            acc.push(allSelected[i].getAttribute("id"));
        }
        $("#bookables").val(JSON.stringify(acc));
    }

    $(window).load(function(){
        $(".seat").click(function () {
            if (!$(this).hasClass("disabled"))
            {
                $(this).toggleClass("selected");
                updateSelectedHiddenField();
            }
        });
    });

    $(window).load(function(){
        $(".room-saloon").click(function () {
            if (!$(this).hasClass("disabled"))
            {
                $(this).toggleClass("selected");
                updateSelectedHiddenField();
            }
        });
    });

    table43 = [43,1,2,3,4,12,13,16,17,23,24,25,26];
    table44 = [44,5,6,7,8,14,15,18,19,27,28,29,30];
    table45 = [45,9,10,11,20,21,22];
    table46 = [46,31,32,35,36];
    table47 = [47,33,34,37,38];
    table48 = [48,39,40];
    table49 = [49,41,42];

    var tables = [table43, table44, table45, table46, table47, table48, table49];

    $(window).load(function(){
        $(".room-table").click(function () {
            if (!$(this).hasClass("disabled"))
            {
                $(this).toggleClass("selected");
                if (($(this).get(0).id) == 43)
                {
                    if ($(this).hasClass("selected"))
                    {
                        if (!$(this).hasClass("disabled")) {
                            $("#1").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#2").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#3").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#4").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#12").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#13").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#16").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#17").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#23").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#24").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#25").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#26").addClass("selected");
                        }
                    }
                    else
                    {
                        $("#1").removeClass("selected");
                        $("#2").removeClass("selected");
                        $("#3").removeClass("selected");
                        $("#4").removeClass("selected");
                        $("#12").removeClass("selected");
                        $("#13").removeClass("selected");
                        $("#16").removeClass("selected");
                        $("#17").removeClass("selected");
                        $("#23").removeClass("selected");
                        $("#24").removeClass("selected");
                        $("#25").removeClass("selected");
                        $("#26").removeClass("selected");
                    }

                }
                else if (($(this).get(0).id) == 44)
                {
                    if ($(this).hasClass("selected"))
                    {
                        if (!$(this).hasClass("disabled")) {
                            $("#5").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#6").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#7").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#8").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#14").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#15").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#18").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#19").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#27").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#28").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#29").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#30").addClass("selected");
                        }
                    }
                    else
                    {
                        $("#5").removeClass("selected");
                        $("#6").removeClass("selected");
                        $("#7").removeClass("selected");
                        $("#8").removeClass("selected");
                        $("#14").removeClass("selected");
                        $("#15").removeClass("selected");
                        $("#18").removeClass("selected");
                        $("#19").removeClass("selected");
                        $("#27").removeClass("selected");
                        $("#28").removeClass("selected");
                        $("#29").removeClass("selected");
                        $("#30").removeClass("selected");
                    }

                }
                else if (($(this).get(0).id) == 45)
                {
                    if ($(this).hasClass("selected"))
                    {
                        if (!$(this).hasClass("disabled")) {
                            $("#9").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#10").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#11").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#20").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#21").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#22").addClass("selected");
                        }
                    }
                    else
                    {
                        $("#9").removeClass("selected");
                        $("#10").removeClass("selected");
                        $("#11").removeClass("selected");
                        $("#20").removeClass("selected");
                        $("#21").removeClass("selected");
                        $("#22").removeClass("selected");
                    }


                }
                else if (($(this).get(0).id) == 46)
                {
                    if ($(this).hasClass("selected"))
                    {
                        if (!$(this).hasClass("disabled")) {
                            $("#31").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#32").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#35").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#36").addClass("selected");
                        }
                    }
                    else
                    {
                        $("#31").removeClass("selected");
                        $("#32").removeClass("selected");
                        $("#35").removeClass("selected");
                        $("#36").removeClass("selected");
                    }
                }
                else if (($(this).get(0).id) == 47)
                {
                    if ($(this).hasClass("selected"))
                    {
                        if (!$(this).hasClass("disabled")) {
                            $("#33").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#34").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#37").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#38").addClass("selected");
                        }
                    }
                    else
                    {
                        $("#33").removeClass("selected");
                        $("#34").removeClass("selected");
                        $("#37").removeClass("selected");
                        $("#38").removeClass("selected");
                    }
                }
                else if (($(this).get(0).id) == 48)
                {
                    if ($(this).hasClass("selected"))
                    {
                        if (!$(this).hasClass("disabled")) {
                            $("#39").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#40").addClass("selected");
                        }
                    }
                    else
                    {
                        $("#39").removeClass("selected");
                        $("#40").removeClass("selected");
                    }
                }
                else if (($(this).get(0).id) == 49)
                {
                    if ($(this).hasClass("selected"))
                    {
                        if (!$(this).hasClass("disabled")) {
                            $("#41").addClass("selected");
                        }
                        if (!$(this).hasClass("disabled")) {
                            $("#42").addClass("selected");
                        }
                    }
                    else
                    {
                        $("#41").removeClass("selected");
                        $("#42").removeClass("selected");
                    }
                }

                updateSelectedHiddenField();
            }
        });
    });


</script>


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
        <td>_</td>	<td class="seat" id="1">___</td>	<td>_</td>	<td class="seat" id="2">___</td>	<td>_</td>
        <td class="seat" id="3">___</td>	<td>_</td>	<td class="seat" id="4">___</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td class="seat" id="5">___</td>	<td>_</td>	<td class="seat" id="6">___</td>	<td>_</td>
        <td class="seat" id="7">___</td>	<td>_</td>	<td class="seat" id="8">___</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td class="seat" id="9">___</td>	<td>_</td>	<td class="seat" id="10">___</td>	<td>_</td>
        <td class="seat" id="11">___</td>	<td>_</td>	<td>_</td>
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
        <td>_</td>	<td  class="seat" id="12">___</td>	<td>_</td>	<td  class="room-table" id="43" colspan="3" rowspan="3">Stůl 1</td>	<td>_</td>	<td class="seat" id="13">___</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td  class="seat" id="14">___</td>	<td>_</td>	<td  class="room-table" id="44" colspan="3" rowspan="3">Stůl 2</td>
        <td>_</td>	<td class="seat" id="15">___</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td class="room-table" id="45" colspan="5" rowspan="2">Stůl 3</td>	<td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 5 -->
        <td>_</td>	<td>_</td>	<td>_</td>   <td>_</td>	<td>___</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 6 -->
        <td>_</td>	<td class="seat" id="16">___</td>	<td>_</td>	<td>_</td>	<td class="seat" id="17">___</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td class="seat" id="18">___</td>	<td>_</td>	<td>_</td>	<td class="seat" id="19">___</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 7 -->
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td class="seat" id="20">___</td>	<td>_</td>	<td class="seat" id="21">___</td>	<td>_</td>
        <td class="seat" id="22">___</td>	<td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 8 -->
        <td>_</td>	<td class="seat" id="23">___</td>	<td>_</td>	<td  class="seat" id="24">___</td>	<td>_</td>
        <td class="seat" id="25">___</td>	<td>_</td>	<td class="seat" id="26">___</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td class="seat" id="27">___</td>	<td>_</td>	<td class="seat" id="28">___</td>	<td>_</td>
        <td class="seat" id="29">___</td>	<td>_</td>	<td class="seat" id="30">___</td>	<td>_</td>	<td>_</td>
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
        <td>_</td>	<td>_</td>	<td class="room-saloon" id="50" rowspan="11" colspan="11">Salonek</td>
    </tr>

    <tr> <!-- 12 -->
        <td>_</td>	<td class="seat" id="31">___</td>	<td>_</td>	<td class="room-table" id="46" rowspan="3" colspan="2">Stůl 4</td>	<td>_</td>	<td class="seat" id="32">___</td>	<td>_</td>	<td>_</td>	<td class="seat" id="33">___</td>
        <td>_</td>	<td class="room-table" id="47" rowspan="3" colspan="2">Stůl 5</td>	<td>_</td>	<td class="seat" id="34">___</td>
        <td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 13 -->
        <td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>	<td>_</td>
        <td>_</td>	<td>_</td>
    </tr>

    <tr> <!-- 14 -->
        <td>_</td>	<td class="seat" id="35">___</td>	<td>_</td>
        <td>_</td>	<td class="seat" id="36">___</td>	<td>_</td>	<td>_</td>	<td class="seat" id="37">___</td>
        <td>_</td>	<td>_</td>	<td class="seat" id="38">___</td>
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
        <td>_</td>	<td class="seat" id="39">___</td>	<td>_</td>
        <td>_</td>	<td class="seat" id="40">___</td>	<td>_</td>	<td>_</td>	<td class="seat" id="41">___</td>
        <td>_</td>	<td>_</td>	<td class="seat" id="42">___</td>
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