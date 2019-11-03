var produtos = {
    items: [],
    venda: 0,
    setItem: function(id, descricao, und, qtd, vol, valor) {
        var found = false;
        for (var i in this.items) {
            if (this.items[i].id == id) {
                this.items[i].qtd = parseFloat(qtd.toFixed(2));
                found = true;
            }
        }
        if (found == false) {
            this.items.push({
                id: id,
                descricao: descricao,
                und: und,
                qtd: parseFloat(qtd).toFixed(2),
                vol: vol,
                valor: parseFloat(valor).toFixed(2)
            });
        }
        this.showItems();
    },
    showItems: function() {
        var tr = "";
        for (var i in this.items) {
            tr += "<tr class='trProd'>" +
                "<td>" + this.items[i].descricao + "</td>" +
                "<td>" + this.items[i].und + "</td>" +
                "<td>" +
                "<input onchange='updateSubTotal(this);'  data-id='" + this.items[i].id + "' style='margin:0;' name='quant[" + this.items[i].id + "]' type='number'  min='0.01'  step='0.01' class='pQuant qtdInput' value='" + this.items[i].qtd + "' data-price='" + this.items[i].valor + "'/>" +
                "</td>" +
                "<td> " +
                "<input onchange='updateSubTotalValor(this);' data-id='" + this.items[i].id + "' style='margin:0;' type='number'  min='0.01'  step='0.01' class='pQuant qtdInput' value='" + parseFloat(this.items[i].valor).toFixed(2) + "'/>" +
                "</td>" +
                "<td> " +
                "<input onchange='updateSubTotalVol(this);' data-id='" + this.items[i].id + "' style='margin:0;' type='number'  min='1'  class='pQuant qtdInput' value='" + this.items[i].vol + "'/>" +
                "</td>" +
                "<td class='subTotal'>R$ " + parseFloat((this.items[i].valor * this.items[i].qtd).toFixed(2)).toLocaleString('pt-BR') + "</td>" +
                "<td><a href='javascript:;' onclick='produtos.excluirProd(" + this.items[i].id + ");' class='btn btn-danger'>X</a></td>" +
                "</tr>";

        }
        $("#tabelaProdutos tbody").html(tr);
    },
    updateItem: function(id, qtd) {
        for (var i in this.items) {
            if (this.items[i].id == id) {
                this.items[i].qtd = parseFloat(qtd.toFixed(2));
            }
        }
        this.showItems();
    },
    updateItemValor: function(id, vl) {
        for (var i in this.items) {
            if (this.items[i].id == id) {
                this.items[i].valor = parseFloat(vl.toFixed(2));
            }
        }
        this.showItems();
    },
    updateItemVol: function(id, vl) {
        for (var i in this.items) {
            if (this.items[i].id == id) {
                this.items[i].vol = parseInt(vl);
            }
        }
        this.showItems();
    },
    excluirProd: function(id) {
        for (var i in this.items) {
            if (id == this.items[i].id) {
                this.items.splice(i, 1);
            }
        }
        this.showItems();
        $("input[name=produtosValor]").val(this.getTotal().toLocaleString('pt-BR'));
        $("input[name=produtosValor]").trigger('change');
    },
    getTotal: function() {
        var ret = 0.00;
        for (var i in this.items) {
            ret += (this.items[i].qtd * this.items[i].valor);
        }

        return parseFloat(ret.toFixed(2));
    },
    getItems: function() {
        return this.items;
    }


};