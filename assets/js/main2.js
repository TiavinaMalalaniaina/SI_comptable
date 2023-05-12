function verified(){
    var index = 0;
    var input = document.getElementsByClassName(index);
    while (input != null || length(input)!=0) {
        console.log(input);
        input.forEach(ina => {
            if (sum(ina) == 100) {
                return true;
            }
        });
        index ++;
        input = document.getElementsByClassName(index);
    }
    return false;
}


function sum(tab){
    var sol = 0;
    tab.forEach(t => {
        sol += t;
    });
    return sol;
}

function unabilityToValide() {
    var button = document.getElementById('validate');
    if (verified()) {
        button.disabled = false;
    }
    else {
        button.disabled = true;
    }
}