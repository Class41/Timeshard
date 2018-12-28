var shardactive = false;

function toggleshard(button) {
    selection = document.getElementById("taskselector");
    memoval = "";

    if(selection.value.length > 0)
    {
        shardactive = !shardactive;
        if(shardactive)
        {
            button.value = "End";

            button.classList.add("buttonroundred");
            button.classList.remove("buttongreen");

            selection.disabled = true;
        }
        else
        {
            button.value = "Begin";
            button.classList.add("buttongreen");
            button.classList.remove("buttonroundred");

            selection.disabled = false;

            memo = document.getElementById("shardmemo");
            memoval = memo.value;

            memo.value = "";
            updatecounter(memo);
        }
    }

}

function updatecounter(memo) {
    var counter = document.getElementById("inputcount");
    
    counter.innerText = memo.value.length + "/100" 
}