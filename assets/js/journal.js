    function addOperation() {
        var line = document.getElementsByClassName('writing-journal');
        var table = document.getElementById('table-add-journal');
        var copy = line[0].cloneNode(true);
        copy.childNodes.forEach(td => {
            td.childNodes.forEach(input => {
                if (input.id == "compteg") input.value = "";
                if (input.id == "comptet") input.value = "";
                if (input.id == "libelle") input.value = "";
                if (input.id == "echeance") input.value = "";
                if (input.id == "devise") input.value = "";
                if (input.id == "parite") input.value = "";
                if (input.id == "quantite") input.value = "";
                if (input.id == "montant") input.value = "";
            });
        });
        table.appendChild(copy);
    }

    function getDate() {
        var line = document.getElementsByClassName('writing-journal');
        var table = document.getElementById('table-add-journal');
        var copy = line[0].cloneNode(true);
        let date = null;
        let npiece = null;
        let libelle = null;
        copy.childNodes.forEach(td => {
            td.childNodes.forEach(input => {
                if (input.id == "jour")  date = input.value;
                if (input.id == "npiece")  npiece = input.value;
                if (input.id == "libelle")  libelle = input.value;
            });
        });
        return [date,npiece,libelle];
    }


    function getDifference() {
        var debit = document.getElementsByClassName('debit');
        var credit = document.getElementsByClassName('credit');
        var sumdebit = 0;
        var sumcredit = 0;
        for (let i = 0; i < debit.length; i++) {
            let d = 0;
            let c = 0;
            if (debit[i].value != '') {
                d=parseInt(debit[i].value);
            } 
            if (credit[i].value != '') {
                c=parseInt(credit[i].value);
            } 
            sumdebit = sumdebit + d;
            sumcredit = sumcredit + c;
        }
        return sumdebit - sumcredit;
    }


    function unabilityToValide() {
        var button = document.getElementById('validate');
        if (getDifference() == 0) {
            button.hidden = false;
        }
        else {
            button.hidden = true;
        }
    }

    function savecopy() {
        var line = document.getElementsByClassName('writing-journal');
        var copy = line[0].cloneNode(true);
        copy.childNodes.forEach(td => {
            td.childNodes.forEach(input => {
                if (input.id == "compteg") input.value = "";
                if (input.id == "comptet") input.value = "";
                if (input.id == "libelle") input.value = "";
                if (input.id == "echeance") input.value = "";
            });
        });
        return copy;
    }

    
    
    function addLine(co) {    
        var table = document.getElementById('table-add-journal');
        var copy = co.cloneNode(true);
        let d = getDate();
        copy.childNodes.forEach(td => {
            td.childNodes.forEach(input => {
                let bit = getDifference();
                if (bit < 0) {
                    if (input.id == "debit") input.placeholder = -bit;
                    if (input.id == "debit") input.value = "";
                    if (input.id == "credit") input.value = "";
                } else {
                    if (input.id == "credit") input.placeholder = bit;
                    if (input.id == "debit") input.value = "";
                    if (input.id == "credit") input.value = "";
                } 
                if (input.id == "jour") input.value = d[0];
                if (input.id == "npiece") input.value = d[1];
                if (input.id == "libelle") input.value = d[2];  
            });
        });
        table.append(copy);
    }
    
var co = savecopy();