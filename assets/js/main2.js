function verified(){
    var index = 0;
    var input = Array.from(document.getElementsByClassName(index));
    console.log(input);
    while (input.length!=0) {
    //     console.log(index);
            
        if (sum(input) != 100) {
            return false;
        }
        index++;
        input = Array.from(document.getElementsByClassName(index));
        console.log(index);
        console.log(input);
    }
    return true;
}


function sum(tab){
    var sol = 0;
    tab.forEach(t => {
        sol += parseInt(t.value);

    });
    console.log(sol);
    return sol;
}

function unabilityToValide() {
    var button = document.getElementById('validate');
    if (verified()) {
        console.log(true);
        button.disabled = false;
    }
    else {
        console.log(false);
        button.disabled = true;
    }
}