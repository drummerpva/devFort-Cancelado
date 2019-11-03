$(function() {
    $("input[name=cnpj]").mask("00.000.000/0000-00", { reverse: true });
    $("input[name=cep]").mask("00.000-000", { reverse: true });
    $("input[name=fone]").mask("(00) 0000-0000", {});
    $("input[name=celular]").mask("(00) 0.0000-0000", {});
    $("input[name=comissao]").mask("#0,00", { reverse: true });
    $("input[name=qtd]").mask("#.##0,00", { reverse: true });
    $("input[name=valor]").mask("#.##0,00", { reverse: true });
    $("input[name=outroValor]").mask("#.##0,00", { reverse: true });
    $("input[name=descontoValor]").mask("#.##0,00", { reverse: true });

    $("#buscaCliente").on("blur", function() {
        $(this).val("");
        setTimeout(function() {
            $(".searchResults").slideUp("fast");
        }, 200);
    });
    $("#buscaCliente").on("keyup", function() {
        if ($(this).val() != "") {
            var url = BASE_URL + "ajax/" + $(this).attr("data-type");
            var q = $(this).val();
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                data: {
                    q: q
                },
                success: function(json) {
                    if ($(".searchResults").length == 0) {
                        $("#buscaCliente")
                            .after("<div class='searchResults'></div>")
                            .slideDown("fast");
                    }
                    $(".searchResults").css(
                        "left",
                        $("#buscaCliente").offset().left - 15 + "px"
                    );
                    $(".searchResults").css(
                        "top",
                        $("#buscaCliente").offset().top +
                        $("#buscaCliente").height() -
                        43 +
                        "px"
                    );

                    var html = "";
                    for (var i in json) {
                        html +=
                            "<div class='si' ><a href ='" +
                            json[i].link +
                            "'  >" +
                            json[i].nome +
                            "</a></div>";
                    }

                    $(".searchResults").html(html);
                    $(".searchResults").slideDown("fast");
                }
            });
        }
    });
    $("#buscaFornecedor").on("blur", function() {
        $(this).val("");
        setTimeout(function() {
            $(".searchResults").slideUp("fast");
        }, 200);
    });
    $("#buscaFornecedor").on("keyup", function() {
        if ($(this).val() != "") {
            var url = BASE_URL + "ajax/" + $(this).attr("data-type");
            var q = $(this).val();
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                data: {
                    q: q
                },
                success: function(json) {
                    if ($(".searchResults").length == 0) {
                        $("#buscaFornecedor")
                            .after("<div class='searchResults'></div>")
                            .slideDown("fast");
                    }
                    $(".searchResults").css(
                        "left",
                        $("#buscaFornecedor").offset().left - 15 + "px"
                    );
                    $(".searchResults").css(
                        "top",
                        $("#buscaFornecedor").offset().top +
                        $("#buscaFornecedor").height() -
                        43 +
                        "px"
                    );

                    var html = "";
                    for (var i in json) {
                        html +=
                            "<div class='si' ><a href ='" +
                            json[i].link +
                            "'  >" +
                            json[i].nome +
                            "</a></div>";
                    }

                    $(".searchResults").html(html);
                    $(".searchResults").slideDown("fast");
                }
            });
        }
    });
    $("#buscaVendedor").on("blur", function() {
        $(this).val("");
        setTimeout(function() {
            $(".searchResults").slideUp("fast");
        }, 200);
    });
    $("#buscaVendedor").on("keyup", function() {
        if ($(this).val() != "") {
            var url = BASE_URL + "ajax/" + $(this).attr("data-type");
            var q = $(this).val();
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                data: {
                    q: q
                },
                success: function(json) {
                    if ($(".searchResults").length == 0) {
                        $("#buscaVendedor")
                            .after("<div class='searchResults'></div>")
                            .slideDown("fast");
                    }
                    $(".searchResults").css(
                        "left",
                        $("#buscaVendedor").offset().left - 15 + "px"
                    );
                    $(".searchResults").css(
                        "top",
                        $("#buscaVendedor").offset().top +
                        $("#buscaVendedor").height() -
                        43 +
                        "px"
                    );

                    var html = "";
                    for (var i in json) {
                        html +=
                            "<div class='si' ><a href ='" +
                            json[i].link +
                            "'  >" +
                            json[i].nome +
                            "</a></div>";
                    }

                    $(".searchResults").html(html);
                    $(".searchResults").slideDown("fast");
                }
            });
        }
    });
    $("#buscaProduto").on("blur", function() {
        $(this).val("");
        setTimeout(function() {
            $(".searchResults").slideUp("fast");
        }, 200);
    });
    $("#buscaProduto").on("keyup", function() {
        if ($(this).val() != "") {
            var url = BASE_URL + "ajax/" + $(this).attr("data-type");
            var q = $(this).val();
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                data: {
                    q: q
                },
                success: function(json) {
                    if ($(".searchResults").length == 0) {
                        $("#buscaProduto")
                            .after("<div class='searchResults'></div>")
                            .slideDown("fast");
                    }
                    $(".searchResults").css(
                        "left",
                        $("#buscaProduto").offset().left - 15 + "px"
                    );
                    $(".searchResults").css(
                        "top",
                        $("#buscaProduto").offset().top +
                        $("#buscaProduto").height() -
                        43 +
                        "px"
                    );

                    var html = "";
                    for (var i in json) {
                        html +=
                            "<div class='si' ><a href ='" +
                            json[i].link +
                            "'  >" +
                            json[i].nome +
                            "</a></div>";
                    }

                    $(".searchResults").html(html);
                    $(".searchResults").slideDown("fast");
                }
            });
        }
    });
    $("#buscaVenda").on("blur", function() {
        //$(this).val("");
        setTimeout(function() {
            $(".searchResults").slideUp("fast");
        }, 200);
    });
    $("#buscaVenda").on("keyup", function() {
        if ($(this).val() != "") {
            var url = BASE_URL + "ajax/" + $(this).attr("data-type");
            var q = $(this).val();
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                data: {
                    q: q
                },
                success: function(json) {
                    $(".searchResults").remove();
                    if ($(".searchResults").length == 0) {
                        $("#buscaVenda")
                            .after("<div class='searchResults' style='width:425px;'></div>")
                            .slideDown("fast");
                    }
                    $(".searchResults").css(
                        "left",
                        $("#buscaVenda").offset().left - 20 + "px"
                    );
                    $(".searchResults").css(
                        "top",
                        $("#buscaVenda").offset().top +
                        $("#buscaVenda").height() -
                        45 +
                        "px"
                    );

                    var html = "";
                    for (var i in json) {
                        html += "<div class='si' ><a href ='" + json[i].link + "'>" + json[i].cliente + " | " + json[i].data + " | " + json[i].valor + "</a></div>";
                    }

                    $(".searchResults").html(html);
                    $(".searchResults").slideDown("fast");
                }
            });
        }
    });
    $("#buscaVendaVendedor").on("blur", function() {
        //$(this).val("");
        setTimeout(function() {
            $(".searchResults").slideUp("fast");
        }, 200);
    });
    $("#buscaVendaVendedor").on("keyup", function() {
        if ($(this).val() != "") {
            var url = BASE_URL + "ajax/" + $(this).attr("data-type");
            var q = $(this).val();
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                data: {
                    q: q
                },
                success: function(json) {
                    $(".searchResults").remove();
                    if ($(".searchResults").length == 0) {
                        $("#buscaVendaVendedor")
                            .after("<div class='searchResults' style='width:450px;'></div>")
                            .slideDown("fast");
                    }
                    $(".searchResults").css(
                        "left",
                        $("#buscaVendaVendedor").offset().left - 40 + "px"
                    );
                    $(".searchResults").css(
                        "top",
                        $("#buscaVendaVendedor").offset().top +
                        $("#buscaVendaVendedor").height() -
                        157 +
                        "px"
                    );

                    var html = "";
                    for (var i in json) {
                        html += "<div class='si' ><a href ='javascript:;'  onclick='selectVendedor(this);' data-id='" + json[i].Id + "' >" + json[i].nome + "</a></div>";
                    }

                    $(".searchResults").html(html);
                    $(".searchResults").slideDown("fast");
                }
            });
        }
    });
    $("#buscaVendaCliente").on("blur", function() {
        //$(this).val("");
        setTimeout(function() {
            $(".searchResults").slideUp("fast");
        }, 200);
    });
    $("#buscaVendaCliente").on("keyup", function() {
        if ($(this).val() != "") {
            var url = BASE_URL + "ajax/" + $(this).attr("data-type");
            var q = $(this).val();
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                data: {
                    q: q
                },
                success: function(json) {
                    $(".searchResults").remove();
                    if ($(".searchResults").length == 0) {
                        $("#buscaVendaCliente")
                            .after("<div class='searchResults' style='width:500px;'></div>")
                            .slideDown("fast");
                    }
                    $(".searchResults").css(
                        "left",
                        $("#buscaVendaCliente").offset().left - 40 + "px"
                    );
                    $(".searchResults").css(
                        "top",
                        $("#buscaVendaCliente").offset().top +
                        $("#buscaVendaCliente").height() -
                        157 +
                        "px"
                    );

                    var html = "";
                    for (var i in json) {
                        html += "<div class='si' ><a href ='javascript:;'  onclick='selectCliente(this);' data-id='" + json[i].Id + "' >" + json[i].nome + "</a></div>";
                    }

                    $(".searchResults").html(html);
                    $(".searchResults").slideDown("fast");
                }
            });
        }
    });
    $("#addProd").on("blur", function() {
        $(this).val("");
        setTimeout(function() {
            $(".searchResults").slideUp("fast");
        }, 200);
    });
    $("#addProd").on("keyup", function() {
        if ($(this).val() != "") {
            var url = BASE_URL + "ajax/" + $(this).attr("data-type");
            var q = $(this).val();
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                data: {
                    q: q
                },
                success: function(json) {
                    $(".searchResults").remove();
                    if ($(".searchResults").length == 0) {
                        $("#addProd")
                            .after("<div class='searchResults' style='width:500px;'></div>")
                            .slideDown("fast");
                    }
                    $(".searchResults").css(
                        "left",
                        $("#addProd").offset().left - 40 + "px"
                    );
                    $(".searchResults").css(
                        "top",
                        $("#addProd").offset().top +
                        $("#addProd").height() -
                        445 +
                        "px"
                    );

                    var html = "";
                    for (var i in json) {
                        html += "<div class='si' ><a href ='javascript:;'  onclick='addProd(this);' data-und='" + json[i].und + "' data-id='" + json[i].Id + "' data-valor='" + json[i].valor + "' data-nome='" + json[i].nome + "'>" + json[i].nome + " - R$ " + json[i].valor.toLocaleString('pt-BR', { minimumFractionDigits: 2 }) + "</a></div>";
                    }

                    $(".searchResults").html(html);
                    $(".searchResults").slideDown("fast");
                }
            });
        }
    });
    $("#buscaVendaPagamentos").on("blur", function() {
        //$(this).val("");
        setTimeout(function() {
            $(".searchResults").slideUp("fast");
        }, 200);
    });
    $("#buscaVendaPagamentos").on("keyup", function() {
        if ($(this).val() != "") {
            var url = BASE_URL + "ajax/" + $(this).attr("data-type");
            var q = $(this).val();
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                data: {
                    q: q
                },
                success: function(json) {
                    $(".searchResults").remove();
                    if ($(".searchResults").length == 0) {
                        $("#buscaVendaPagamentos")
                            .after("<div class='searchResults' style='width:350px;'></div>")
                            .slideDown("fast");
                    }
                    $(".searchResults").css(
                        "left",
                        $("#buscaVendaPagamentos").offset().left - 40 + "px"
                    );
                    $(".searchResults").css(
                        "top",
                        $("#buscaVendaPagamentos").offset().top +
                        $("#buscaVendaPagamentos").height() -
                        445 +
                        "px"
                    );

                    var html = "";
                    for (var i in json) {
                        html += "<div class='si' ><a href ='javascript:;'  onclick='selectPagamento(this);' data-id='" + json[i].Id + "' >" + json[i].descricao + "</a></div>";
                    }

                    $(".searchResults").html(html);
                    $(".searchResults").slideDown("fast");
                }
            });
        }
    });

    $("#togglePFPJ").on("click", function() {
        if ($(this).val() == "Pessoa Jurídica") {
            $(this).val("Pessoa Física");
            $("input[name=cnpj]").mask("000.000.000-00", { reverse: true }).attr("placeholder", "CPF");
        } else {
            $(this).val("Pessoa Jurídica");
            $("input[name=cnpj]").mask("00.000.000/0000-00", { reverse: true }).attr("placeholder", "CNPJ");
        }
    });
    $("input[name=produtosValor], input[name=outroValor], input[name=descontoValor]").on('change', function() {
        var prod = parseFloat(produtos.getTotal());
        var outros = ($("input[name=outroValor]").val() != "") ? parseFloat($("input[name=outroValor]").val().replace(".", "").replace(",", ".")) : 0.00;
        var desconto = ($("input[name=descontoValor]").val() != "") ? parseFloat($("input[name=descontoValor]").val().replace(".", "").replace(",", ".")) : 0.00;
        var total = parseFloat(((prod + outros) - desconto).toFixed(2));
        $("input[name=totalValor]").val(total.toLocaleString('pt-BR'));

    });

});

function ordenaClientes(ordem) {
    window.location.href = BASE_URL + "clientes/?ordem=" + ordem;
}

function ordenaEmitentes(ordem) {
    window.location.href = BASE_URL + "emitentes/?ordem=" + ordem;
}

function ordenaFornecedores(ordem) {
    window.location.href = BASE_URL + "fornecedores/?ordem=" + ordem;
}

function ordenaFuncionarios(ordem) {
    window.location.href = BASE_URL + "funcionarios/?ordem=" + ordem;
}

function ordenaVendedores(ordem) {
    window.location.href = BASE_URL + "vendedores/?ordem=" + ordem;
}

function ordenaVendas(ordem) {
    window.location.href = BASE_URL + "vendas/?ordem=" + ordem;
}

function addProd(obj) {
    var id = $(obj).attr('data-id');
    var name = $(obj).attr('data-nome');
    var und = $(obj).attr('data-und');
    var price = parseFloat($(obj).attr("data-valor"));
    $(".searchResults").slideUp('fast');
    $("#addProd").val("");
    $("#addProd").focus();
    produtos.setItem(id, name, und, 1, 1, price);
    total = produtos.getTotal();
    $("input[name=produtosValor]").val(total.toLocaleString('pt-BR')).trigger('change');
    //updateSubTotal();
}

function updateSubTotal(obj) {
    var quant = parseFloat($(obj).val());
    var id = $(obj).attr("data-id");
    quant = parseFloat(quant.toFixed(2));
    produtos.updateItem(id, quant);
    total = produtos.getTotal();
    $("input[name=produtosValor]").val(total.toLocaleString('pt-BR')).trigger('change');
}

function updateSubTotalValor(obj) {
    var vlr = parseFloat($(obj).val());
    var id = $(obj).attr("data-id");
    quant = parseFloat(vlr.toFixed(2));
    produtos.updateItemValor(id, vlr);
    total = produtos.getTotal();
    $("input[name=produtosValor]").val(total.toLocaleString('pt-BR')).trigger('change');
}

function updateSubTotalVol(obj) {
    var vlr = parseInt($(obj).val());
    var id = $(obj).attr("data-id");
    produtos.updateItemVol(id, vlr);
    $("input[name=produtosValor]").trigger('change');
}

function selectVendedor(obj) {
    var id = $(obj).attr('data-id');
    var name = $(obj).html();
    $(".searchResults").slideUp('fast');
    $("#buscaVendaVendedor").val(name);
    $("input[name=vendedorId]").val(id);
}

function selectPagamento(obj) {
    var id = $(obj).attr('data-id');
    var name = $(obj).html();
    $(".searchResults").slideUp('fast');
    $("#buscaVendaPagamentos").val(name);
    $("input[name=pagamentoId]").val(id);
}

function selectCliente(obj) {
    var id = $(obj).attr('data-id');
    var name = $(obj).html();
    $(".searchResults").slideUp('fast');
    $("#buscaVendaCliente").val(name);
    $("input[name=clienteId]").val(id);
}

function salvaPedido(obj) {
    var vendedor = $("input[name=vendedorId]").val();
    var cliente = $("input[name=clienteId]").val();
    var pagamentoId = $("input[name=pagamentoId]").val();
    //var outro = parseFloat(($("input[name=outroValor]").val() == "") ? '0.00' : $("input[name=outroValor]").val().replace(".","").replace(",","."));
    var outro = parseFloat(($("input[name=outroValor]").val() == "") ? '0.00' : $("input[name=outroValor]").val().replace(".", "").replace(",", "."));
    var outroValor = parseFloat(outro).toFixed(2);
    var desconto = parseFloat(($("input[name=descontoValor]").val() == "") ? '0.00' : $("input[name=descontoValor]").val().replace(".", "").replace(",", "."));
    var descontoValor = parseFloat(desconto).toFixed(2);
    var prodsValor = parseFloat(produtos.getTotal()).toFixed(2);
    var tot = (((outro + produtos.getTotal()) - desconto)).toFixed(2);
    var descOutro = $("textarea[name=outroDescricao]").val();
    var descDesconto = $("textarea[name=descontoDescricao]").val();
    var obs = $("textarea[name=obs]").val();
    //alert("Vendedor: "+vendedor+"\n Cliente: "+cliente+"\n Outro: "+outroValor+"\n Desconto: "+descontoValor+"\n Produtos: "+prodsValor+"\n Total: "+tot+"\n descOutro: "+descOutro+"\n descDesconto: "+descDesconto);
    var items = produtos.getItems();
    var url = BASE_URL + "ajax/insereCabecalhoVenda";
    var idV1 = 0;
    var totI1 = items.length - 1;
    $.ajax({
        url: url,
        type: "POST",
        async: false,
        dataType: "json",
        data: {
            vendedor: vendedor,
            cliente: cliente,
            pagamento: pagamentoId,
            outroValor: outroValor,
            outroDescricao: descOutro,
            descontoValor: descontoValor,
            descontoDescricao: descDesconto,
            produtosValor: prodsValor,
            obs: obs,
            total: tot
        },
        success: function(json) {
            if (json.idV != "undefined") {
                idV1 = json.idV;
                //alert("Inserido venda número: "+json.idV)
                for (var i in items) {
                    $.ajax({
                        url: BASE_URL + "ajax/insereProdutoVenda",
                        type: "POST",
                        async: false,
                        dataType: "json",
                        data: {
                            idV: idV1,
                            idP: items[i].id,
                            qtd: items[i].qtd,
                            vol: items[i].vol,
                            valor: items[i].valor
                        },
                        success: function(js) {
                            if (totI1 == i) {
                                window.open(BASE_URL + "vendas/print/" + idV1 + "/?pr=1");
                                window.location.href = BASE_URL + "vendas";
                            }
                        }
                    });
                }

            } else {
                alert("Erro: Não inseriu Venda, verifique");
            }
        }
    });

    return false;
}

function atualizaPedido(obj) {
    var idVenda = $("input[name=vendaId]").val();
    var vendedor = $("input[name=vendedorId]").val();
    var cliente = $("input[name=clienteId]").val();
    var pagamentoId = $("input[name=pagamentoId]").val();
    //var outro = parseFloat(($("input[name=outroValor]").val() == "") ? '0.00' : $("input[name=outroValor]").val().replace(".","").replace(",","."));
    var outro = parseFloat(($("input[name=outroValor]").val() == "") ? '0.00' : $("input[name=outroValor]").val().replace(".", "").replace(",", "."));
    var outroValor = parseFloat(outro).toFixed(2);
    var desconto = parseFloat(($("input[name=descontoValor]").val() == "") ? '0.00' : $("input[name=descontoValor]").val().replace(".", "").replace(",", "."));
    var descontoValor = parseFloat(desconto).toFixed(2);
    var prodsValor = parseFloat(produtos.getTotal()).toFixed(2);
    var tot = (((outro + produtos.getTotal()) - desconto)).toFixed(2);
    var descOutro = $("textarea[name=outroDescricao]").val();
    var descDesconto = $("textarea[name=descontoDescricao]").val();
    var obs = $("textarea[name=obs]").val();
    //alert("Vendedor: "+vendedor+"\n Cliente: "+cliente+"\n Outro: "+outroValor+"\n Desconto: "+descontoValor+"\n Produtos: "+prodsValor+"\n Total: "+tot+"\n descOutro: "+descOutro+"\n descDesconto: "+descDesconto);
    var items = produtos.getItems();
    var url = BASE_URL + "ajax/atualizaCabecalhoVenda";
    var totI = items.length - 1;
    $.ajax({
        url: url,
        type: "POST",
        async: false,
        dataType: "json",
        data: {
            idVenda: idVenda,
            vendedor: vendedor,
            cliente: cliente,
            pagamento: pagamentoId,
            outroValor: outroValor,
            outroDescricao: descOutro,
            descontoValor: descontoValor,
            descontoDescricao: descDesconto,
            produtosValor: prodsValor,
            obs: obs,
            total: tot
        },
        success: function(json) {
            if (json.status != "undefined") {
                idVenda = json.status;
                $.ajax({
                    url: BASE_URL + "ajax/limpaProdutoVenda",
                    type: "POST",
                    async: false,
                    dataType: "json",
                    data: {
                        idVenda: json.status
                    },
                    success: function(js) {
                        idVenda = js.idVenda

                        for (var i in items) {
                            $.ajax({
                                url: BASE_URL + "ajax/insereProdutoVenda",
                                type: "POST",
                                async: false,
                                dataType: "json",
                                data: {
                                    idV: idVenda,
                                    idP: items[i].id,
                                    qtd: items[i].qtd,
                                    vol: items[i].vol,
                                    valor: items[i].valor
                                },
                                success: function(js) {
                                    if (totI == i) {
                                        window.open(BASE_URL + "vendas/print/" + idVenda + "/?pr=1");
                                        window.location.href = BASE_URL + "vendas";
                                    }
                                }
                            });
                        }
                    }
                });

            } else {
                alert("Erro: Não inseriu Venda, verifique");
            }
        }
    });

    return false;
}