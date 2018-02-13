var firstNames = ["Aaren","Aarika","Abagael","Abagail","Abbe","Abbey","Abbi","Abbie","Abby","Abbye","Abigael","Abigail","Abigale","Abra","Ada", "Brandi","Brandice","Brandie","Brandise","Brandy","Breanne","Brear","Bree","Breena","Bren","Brena","Brenda","Brenn","Brenna","Brett","Bria","Briana","Brianna","Brianne","Bride","Bridget","Bridgette","Bridie","Brier","Brietta","Brigid","Calida","Calla","Calley","Calli","Callida","Callie","Cally","Calypso","Cam","Camala","Camel","Camella","Camellia","Cami","Camila","Camile","Camilla","Camille","Cammi","Cammie","Cammy","Candace","Candi","Candice","Dorotea","Doroteya","Dorothea","Dorothee","Dorothy","Dorree","Dorri","Dorrie","Dorris","Dorry","Dorthea","Dorthy","Dory","Dosi","Dot","Doti","Dotti","Dottie","Dotty","Dre","Dreddy","Dredi","Drona","Dru","Druci","Drucie","Drucill","Drucy","Drusi","Drusie","Idell","Idelle","Idette","Ileana","Ileane","Ilene","Ilise","Ilka","Illa","Ilsa","Ilse","Ilysa","Ilyse","Ilyssa","Imelda","Imogen","Imogene","Imojean","Ina"]
var lastNames = ["Heyward","Heywood","Hezekiah","Hi","Hibben","Hibbert","Hibbitts","Hibbs","Hickey","Hickie","Hicks","Hidie","Hieronymus","Hiett","Higbee","Higginbotham","Higgins","Higginson","Higgs","High","Highams","Hightower","Higinbotham","Higley","Hijoung","Hike","Hilaire","Hilar","Hilaria","Hilario","Hilarius","Hilary","Hilbert","Hild","Hilda","Hildagard","Hildagarde","Hilde","Hildebrandt","Minne","Minni","Minnie","Minnnie","Minny","Minor","Minoru","Minsk","Minta","Minton","Mintun","Mintz","Miof Mela","Miquela","Mir","Mira","Mirabel","Mirabella","Mirabelle","Miran","Miranda","Spike","Spillar","Spindell","Spiro","Spiros","Spitzer","Spohr","Spooner","Spoor","Spracklen","Sprage","Spragens","Sprague","Spratt","Spring","Springer","Sproul","Sprung","Spurgeon","Squier","Squire","Thisbee","Thissa","Thistle","Thoer","Thom","Thoma","Thomajan","Thomas","Thomasa","Thomasin","Thomasina","Thomasine","Thomey","Thompson","Thomsen","Thomson","Thor","Thora","Thorbert","Thordia","Thordis","Thorfinn","Thorin","Thorlay","Thorley","Thorlie","Thorma","Thorman","Thormora","Thorn","Thornburg","Thorncombe","Thorndike","Thorne","Thorner","Thornie","Thornton","Thorny","Thorpe","Thorr","Thorrlow","Thorstein","Thorsten","Thorvald","Thorwald","Thrasher","Three","Threlkeld","Thrift","Thun","Thunell","Thurber","Thurlough","Thurlow","Thurman","Thurmann","Thurmond","Thurnau","Thursby","Thurstan","Thurston","Thury","Thynne","Tia","Tiana","Tibbetts","Tibbitts","Tibbs","Tibold"]

function prefillAddUserForm()
{
    var firstName = firstNames[Math.floor(Math.random()*firstNames.length)];
    var lastName = lastNames[Math.floor(Math.random()*lastNames.length)];

    document.getElementById("user-name").value = firstName + " " + lastName;
    document.getElementById("user-email").value = firstName.toLowerCase() + "." + lastName.toLowerCase() + "@mailprovider.com";
    document.getElementById("user-password").value = "password";
    document.getElementById("user-password_confirmation").value = "password";

    for (var i = 0; i < 2; i++)
        $("#passwordHelp").remove();

    $("<small id='passwordHelp' class='form-text text-muted'>Heslo bylo automaticky předvyplněno na hodnotu: password.</small>").insertAfter("#user-password");
    $("<small id='passwordHelp' class='form-text text-muted'>Heslo bylo automaticky předvyplněno na hodnotu: password.</small>").insertAfter("#user-password_confirmation");

    // Randomly select from role selector
    var $options = $("#user-role").find("option"),
        random = ~~(Math.random() * $options.length);
    $options.eq(random).prop('selected', true);
}

function tryPrefillingMenuName()
{
    var startDate = document.getElementById("menu-validity-start").value;
    var endDate = document.getElementById("menu-validity-end").value;

    var currentName = document.getElementById("menu-name").value;

    if (!currentName)
    {
        if (endDate && startDate)
        {
            document.getElementById("menu-name").value = "Menu na " + startDate;
            $("#nameHelp").remove();
            $("<small id='nameHelp' style='color: crimson !important;' class='form-text text-muted'>Jméno menu bylo automaticky doplněno na základě vybraného dne (pro snažší testování)</small>").insertAfter("#menu-name");
            return;
        }

        if (!endDate)
        {
            document.getElementById("menu-name").value = "Menu na " + startDate;
            $("#nameHelp").remove();
            $("<small id='nameHelp' style='color: crimson !important;' class='form-text text-muted'>Jméno menu bylo automaticky doplněno na základě vybraného dne (pro snažší testování)</small>").insertAfter("#menu-name");
            return;
        }

        if (!startDate)
        {
            document.getElementById("menu-name").value = "Menu na " + endDate;
            $("#nameHelp").remove();
            $("<small id='nameHelp' style='color: crimson !important;' class='form-text text-muted'>Jméno menu bylo automaticky doplněno na základě vybraného dne (pro snažší testování)</small>").insertAfter("#menu-name");
        }
    }

    // Do nothing if the name is already present
}