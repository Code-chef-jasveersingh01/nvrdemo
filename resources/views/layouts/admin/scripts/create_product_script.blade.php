@section('script')
<script src={{asset("assets/js/pages/dropify.min.js")}}></script>
<script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script>
    let producttitle = "";
    let sku = "";
    $(document).ready(function () {
        $('.dropify').dropify();
        let page = (window.location.href.indexOf('/catalog/products/edit/') > -1) ? true : false;
        if (page){
            const type = '{{ isset($productDetails->type) ? $productDetails->type : 'Simple Product'  }}';
            if (type == "Configured Product"){
                $('#originalprice').removeAttr('required').attr('disabled',true).val('');
                $('#profitpercentage').removeAttr('required').attr('disabled',true).val('');
                $('#sellingprice').removeAttr('required').attr('disabled',true).val('');
                $('#profit').removeAttr('required').attr('disabled',true).val('');
                $('#stocks').removeAttr('required').attr('disabled',true).val('');
                $('#discount').removeAttr('required').attr('disabled',true).val('');
            }
        }
        $('#originalprice').keyup(function (e) {
            e.preventDefault();
            const cp = $(this).val();
            let ppercent = $('#profitpercentage').val();
            let discountPercentage = $('#discount').val();
            ppercent = (!ppercent.trim()) ? 0 : parseInt(ppercent);
            discountPercentage = (!discountPercentage.trim()) ? 0 : parseInt(discountPercentage);
            const profit = (ppercent !== 0) ? (cp*(ppercent/100)) : ppercent ;
            const discount = (discountPercentage !== 0) ? (cp*(discountPercentage/100)) : ppercent ;
            let sp = (ppercent !== 0) ? parseInt(cp) + (cp*(ppercent/100)) : cp ;
            // sp = (discountPercentage !== 0) ? Math.round((sp*100)/(100-discountPercentage)) : sp ;
            $('#sellingprice').prop('value',sp);
            $('#profit').prop('value',profit);
            // $('#discount').prop('value',discount);
        });
        $('#profitpercentage').keyup(function (e) {
            e.preventDefault();
            const cp = $('#originalprice').val();
            let discountPercentage = $('#discount').val();

            let ppercent = $('#profitpercentage').val();
            ppercent = (!ppercent.trim()) ? 0 : parseInt(ppercent);
            discountPercentage = (!discountPercentage.trim()) ? 0 : parseInt(discountPercentage);

            let profit = (ppercent !== 0) ? cp*(ppercent/100) : ppercent ;

            let sp = (ppercent !== 0) ? (parseInt(cp) + profit) : cp ;
            // sp = (discountPercentage !== 0) ? Math.round((sp*100)/(100-discountPercentage)) : sp ;

            $('#sellingprice').prop('value',sp);
            $('#profit').prop('value',profit);
            // $('#discount').prop('value',discount);
        });
        $('#discount').keyup(function (e) {
            e.preventDefault();
            const cp = $('#originalprice').val();
            let discountPercentage = $('#discount').val();

            let ppercent = $('#profitpercentage').val();
            ppercent = (!ppercent.trim()) ? 0 : parseInt(ppercent);
            discountPercentage = (!discountPercentage.trim()) ? 0 : parseInt(discountPercentage);

            let profit = (ppercent !== 0) ? cp*(ppercent/100): ppercent ;

            let sp = (ppercent !== 0) ? (parseInt(cp) + profit) : cp ;
            // sp = (discountPercentage !== 0) ? Math.round((sp*100)/(100-discountPercentage)) : sp ;

            $('#sellingprice').prop('value',sp);
            $('#profit').prop('value',profit);
            // $('#discount').prop('value',discount);
        });
        $('#originalprice').blur(function (e) {
            e.preventDefault();
            const cp = $(this).val();
            let ppercent = $('#profitpercentage').val();
            let discountPercentage = $('#discount').val();
            ppercent = (!ppercent.trim()) ? 0 : parseInt(ppercent);
            discountPercentage = (!discountPercentage.trim()) ? 0 : parseInt(discountPercentage);
            const profit = (ppercent !== 0) ? (cp*(ppercent/100)) : ppercent ;
            const discount = (discountPercentage !== 0) ? (cp*(discountPercentage/100)) : ppercent ;
            let sp = (ppercent !== 0) ? parseInt(cp) + (cp*(ppercent/100)) : cp ;
            // sp = (discountPercentage !== 0) ? parseInt(sp) + Math.round((sp*100)/(100-discountPercentage)) : sp ;
            $('#sellingprice').prop('value',sp);
            $('#profit').prop('value',profit);
            // $('#discount').prop('value',discount);
        });
        $('#profitpercentage').blur(function (e) {
            e.preventDefault();
            const cp = $('#originalprice').val();
            let discountPercentage = $('#discount').val();

            let ppercent = $('#profitpercentage').val();
            ppercent = (!ppercent.trim()) ? 0 : parseInt(ppercent);
            discountPercentage = (!discountPercentage.trim()) ? 0 : parseInt(discountPercentage);

            let profit = (ppercent !== 0) ? cp*(ppercent/100) : ppercent ;

            let sp = (ppercent !== 0) ? (parseInt(cp) + profit) : cp ;
            // sp = (discountPercentage !== 0) ? Math.round((sp*100)/(100-discountPercentage)) : sp ;

            $('#sellingprice').prop('value',sp);
            $('#profit').prop('value',profit);
            // $('#discount').prop('value',discount);
        });
        $('#discount').blur(function (e) {
            e.preventDefault();
            const cp = $('#originalprice').val();
            let discountPercentage = $('#discount').val();

            let ppercent = $('#profitpercentage').val();
            ppercent = (!ppercent.trim()) ? 0 : parseInt(ppercent);
            discountPercentage = (!discountPercentage.trim()) ? 0 : parseInt(discountPercentage);

            let profit = (ppercent !== 0) ? cp*(ppercent/100): ppercent ;

            let sp = (ppercent !== 0) ? (parseInt(cp) + profit) : cp ;
            // sp = (discountPercentage !== 0) ? Math.round((sp*100)/(100-discountPercentage)) : sp ;

            $('#sellingprice').prop('value',sp);
            $('#profit').prop('value',profit);
            // $('#discount').prop('value',discount);
        });

        $('#producttitleen').keyup(function (e) {
            const value = $(this).val();
            $('#sku').val(value.replace(/\s/g,'-'))
        });

        $("#configurationButton").focus(function (e) {
            e.preventDefault();
            producttitle = $("#producttitle").val();
            sku = $("#sku").val();
            if(sku.length > 0 || producttitle.length > 0){
                $(this).attr('data-bs-toggle',"offcanvas");
                $(this).attr('data-bs-target',"#offcanvasRight");
                $(this).attr('aria-controls',"offcanvasRight");
            }else{
                const message = "Enter Product Titlt and SKU First";
                $(this).removeAttr('data-bs-toggle');
                $(this).removeAttr('data-bs-target');
                $(this).removeAttr('aria-controls');
                variationFailed(0,message)
            }
        });

        $("body").on('click','#configurationButton',function (e) {
            e.preventDefault();
            producttitle = $("#producttitle").val();
            sku = $("#sku").val();
            if (sku.length <= 0) {
                const message = "Enter Product Titlt and SKU First";
                variationFailed(0,message)
            }
        });

        $('#pills-info-desc-tab').focus(function (e) {
            e.preventDefault();
            if ($(".form-input-for-variationType:checkbox:checked").length < 1){
                $('#pills-info-desc-tab').attr('disabled', true);
                $('#pills-info-desc-tab').removeAttr('data-bs-target');
            }
        });

        $('#pills-success-tab').focus(function (e) {
            e.preventDefault();
            if (checkedVariation.length >= 1){
                for (let index = 0; index < checkedVariation.length; index++) {
                    if ($(".form-input-for-variationType-"+index+":checkbox:checked").length < 1){
                        $('#pills-success-tab').attr('disabled', true);
                        $('#pills-success-tab').removeAttr('data-bs-target');
                    }
                }
            }
        });

        $("#checkAllVariationType").click(function () {
            $('.form-input-for-variationType').not(this).prop('checked', this.checked);
        });
    });

        function changeWizard(){
            document.querySelectorAll(".form-steps").forEach(function (form) {

                // next tab
                if (form.querySelectorAll(".nexttab"))
                    form.querySelectorAll(".nexttab").forEach(function (nextButton) {
                        var tabEl = form.querySelectorAll('button[data-bs-toggle="pill"]');
                        tabEl.forEach(function (item) {
                            item.addEventListener('show.bs.tab', function (event) {
                                event.target.classList.add('done');
                            });
                        });
                        nextButton.addEventListener("click", function () {
                            var nextTab = nextButton.getAttribute('data-nexttab');
                            document.getElementById(nextTab).click();
                        });
                    });

                //Pervies tab
                if (form.querySelectorAll(".previestab"))
                    form.querySelectorAll(".previestab").forEach(function (prevButton) {

                        prevButton.addEventListener("click", function () {
                            var prevTab = prevButton.getAttribute('data-previous');
                            var totalDone = prevButton.closest("form").querySelectorAll(".custom-nav .done").length;
                            for (var i = totalDone - 1; i < totalDone; i++) {
                                (prevButton.closest("form").querySelectorAll(".custom-nav .done")[i]) ? prevButton.closest("form").querySelectorAll(".custom-nav .done")[i].classList.remove('done'): '';
                            }
                            document.getElementById(prevTab).click();
                        });
                    });

                // Step number click
                var tabButtons = form.querySelectorAll('button[data-bs-toggle="pill"]');
                if (tabButtons)
                tabButtons.forEach(function (button, i) {
                    button.setAttribute("data-position", i);
                    button.addEventListener("click", function () {
                        var getProgressBar = button.getAttribute("data-progressbar");
                        if (getProgressBar) {
                            var totalLength = document.getElementById("custom-progress-bar").querySelectorAll("li").length - 1;
                            var current = i;
                            var percent = (current / totalLength) * 100;
                            document.getElementById("custom-progress-bar").querySelector('.progress-bar').style.width = percent + "%";
                        }
                        (form.querySelectorAll(".custom-nav .done").length > 0) ?
                        form.querySelectorAll(".custom-nav .done").forEach(function (doneTab) {
                            doneTab.classList.remove('done');
                        }): '';
                        for (var j = 0; j <= i; j++) {
                            tabButtons[j].classList.contains('active') ? tabButtons[j].classList.remove('done') : tabButtons[j].classList.add('done');
                        }
                    });
                });
            });
        }
        async function doVariationValueAjax(args) {
            let result;

            try {
                result = await $.ajax({
                    url: "{{route('admin.variationValue')}}",
                    type: 'POST',
                    data: {
                        "_token": $('a[name="csrf-token"]').val(),
                        "selectedVariation": args,
                    }
                });

                return result;
            } catch (error) {
                console.error(error);
            }
        }

        var checkedVariation = [];
        var checkedVariationName = [];

    $('body').on('click','#variationTypeSumbit',function(e){
        e.preventDefault();
        sumbitSelectedVariationType(this);
    })
    function sumbitSelectedVariationType(data)
    {
        let checkedVariationlocal = [];
        let checkedVariationNamelocal = [];
        var checkedboxesLength = $(".form-input-for-variationType:checkbox:checked").length;

        $(".form-input-for-variationType:checkbox:checked").each(function (index, element) {
           checkedVariationlocal[index] = $(element).data('id');
           checkedVariationNamelocal[index] = $(element).data('name');
        });

        checkedVariation = checkedVariationlocal;
        checkedVariationName = checkedVariationNamelocal;

        if(checkedboxesLength >= 1){
            variationSuccess(data, checkedVariation)
                $('#pills-info-desc-tab').click();
        }
        else{
            const message = "Please Select atleast One Attribute Set";
            variationFailed(data,message)
            return false;
        }
    }

    function variationSuccess(data, checkedVariation)
    {
        $(data).attr('data-nexttab', 'pills-info-desc-tab');
        $('#pills-info-desc-tab').attr('data-bs-target', '#pills-info-desc');
        $('#pills-info-desc-tab').removeAttr('disabled');

        changeWizard();
        doVariationValueAjax(checkedVariation).then( (response) => {
            $('#variationValue').html('');
            const variationValue = variationValueAppend(response.data);
            $('#variationValue').append(variationValue);
        });
    }

    function variationValueAppend(responseData)
    {
        const variationValueData = $.map(responseData, function (element, index) {
            const options = $.map(element.variation, function (value, key) {
                const data = "<div class='form-input'><input type='checkbox' class='filled-in chk-col-primary form-input-for-variationValue-"+element.id+"' name='"+element.id+"["+value.id+"]' id='"+value.id+"' data-name='"+value.name.en+"'/><label style='padding:inherit;' for='"+value.name.en+"'>"+value.name.en+"</label></div>";
                return data;
            }).join(' ');
            const output = "<div class='row'><div class='col-lg-12'><div class='card shadow mb-4'><div class='row card-header py-3 d-flex align-items-center border-0' style='background: none'><h6 class='col-10 m-0 font-weight-bold text-primary flex-grow-1'>"+element.name.en+"</h6></div><div class='card-body'><div class='box box-bordered border-primary'><div class='box-body'><div class='row'>"+options+"</div></div></div></div></div></div></div>";
            return output;
        });
        return variationValueData;
    }

    function cartesianVariationValue(args) {
        var range = [], maxLength = args.length-1;
        function helper(arr, i) {
            for (var j=0, l=args[i].length; j<l; j++) {
                var a = arr.slice(0); // clone arr
                a.push(args[i][j]);
                if (i==maxLength)
                    range.push(a);
                else
                    helper(a, i+1);
            }
        }
        helper([], 0);
        return range;
    }

    function getNameCombo(arr, pre) {
        pre = pre || '';
        if (!arr.length) {
            return pre;
        }
        var ans = arr[0].reduce(function(ans, value){
            return ans.concat(getNameCombo(arr.slice(1), pre + "-" + value.replace(/\s/g,'-')))
        },[]);

        return ans;
    }


    var checkedVariationValue = {};

    function sumbitSelectedVariationValue(data)
    {
        checkedVariationValue = [];
        checkedVariationValueName = [];
        variationReference = {};
        variationReferenceName = {};
        if (checkedVariation.length >= 1){
            $(checkedVariation).each(function (key, element) {

                const strdata = ".form-input-for-variationValue-"+element+":checkbox:checked";

                let comboDataId = [];
                let comboDataName = [];
                $(strdata).each(function (index, valueOfElement) {
                    var keyId = element
                    ,  valueId = parseInt($(valueOfElement).attr('id'));
                    var keyName = element
                    ,  valueName = $(valueOfElement).data('name');
                    comboDataId[index] = valueId;
                    comboDataName[index] = valueName;
                });

                if (Object.keys(comboDataId).length > 0){
                    checkedVariationValue[key] = comboDataId;
                    checkedVariationValueName[key] = comboDataName;
                    variationReference[element] = comboDataId;
                    variationReferenceName[element] = comboDataName;
                }
            });

            if(Object.values(checkedVariationValue).length >= checkedVariation.length){
                const cartesianVariationValueData = cartesianVariationValue(checkedVariationValue);
                const cartesianVariationName = cartesianVariationValue(checkedVariationValueName);

                let comboSku = getNameCombo(checkedVariationValueName,sku);
                const checkSKU = checkedVariationName.filter((e,i)=>{
                    return e === 'SKU';
                });
                if(checkSKU.length == 0){
                    checkedVariationName.unshift('SKU');
                }
                cartesianVariationName.filter((e,i)=>{
                    e.unshift(comboSku[i]);
                });
                variationValueSuccess(comboSku, cartesianVariationValueData, cartesianVariationName);
                $("#configurationCanvasClose").click();

            }
            else{
                const message = "Select options for all attributes or remove unused attributes.";
                variationFailed(data,message)
                return false;
            }
        }
    }

    function configTable(comboSku, cartesianVariationValueData, cartesianVariationName)
    {
        let output;
            try {
                const th = $.map(checkedVariationName, function (elementOrValue, indexOrKey) {
                        return "<th style='text-center'>"+elementOrValue+"</th>";
                    }).join(' ');

                const tr = $.map(cartesianVariationName, function (e, i) {

                    const td = $.map(e, function (variationValue, indexOrKey) {
                        return "<td style='text-center'><input type='hidden' name='variant["+e[0]+"]["+checkedVariationName[indexOrKey]+"]' value='"+variationValue+"'>"+variationValue+"</td>";
                    }).join(' ');

                    return "<tr><td style='width: 15%'><input class='dropify' name='variant["+e[0]+"][image]' type='file' accept='image/png, image/jpeg, image/jpg'/><input type='hidden' name='variant["+e[0]+"][combination]' value='"+JSON.stringify(cartesianVariationValueData[i])+"'></td>"+td+"<td><input class='form-control' name='variant["+e[0]+"][quantity]' type='number' required /></td><td><input class='form-control original_price' data-type="+e[0]+" id='original_price"+e[0]+"' name='variant["+e[0]+"][original_price]' type='number' required /></td><td><input class='form-control profit_percentage' data-type="+e[0]+" id='profit_percentage"+e[0]+"' name='variant["+e[0]+"][profit_percentage]' type='number' required /></td><td><input class='form-control profit' data-type="+e[0]+" id='profit"+e[0]+"' name='variant["+e[0]+"][profit]' type='number' required /></td><td><input class='form-control discount' data-type="+e[0]+" id='discount"+e[0]+"' name='variant["+e[0]+"][discount]' type='number' required /></td><td><input class='form-control price' data-type="+e[0]+" id='price"+e[0]+"' name='variant["+e[0]+"][price]' type='number' required /></td><td><div class='form-check form-switch' dir='ltr'><input type='checkbox' name='variant["+e[0]+"][is_active]' class='form-check-input' id='customSwitchsizesm' checked=''></div></td></tr>";
                }).join(' ');

                output = "<div class='table-responsive'><table class='table table-hover' width='100%' cellspacing='0'><thead><tr><th>Image</th>"+th+"<th style='text-center'>Quantity</th><th style='text-center'>Original Price</th><th style='text-center'>Profit Percentage</th><th style='text-center'>Profit</th><th style='text-center'>Discount</th><th style='text-center'>Price</th><th style='text-center'>Is Active</th></tr></thead><tbody id='tbody'>"+tr+"</tbody></table></div>";
                return output;
            } catch (error) {
                console.log(error);
            }
    }

    function variationValueSuccess(comboSku, cartesianVariationValueData, cartesianVariationName)
    {
        $('#variation').html('');
        const table = configTable(comboSku, cartesianVariationValueData, cartesianVariationName);
        $('#variation').append(table);
        $('.dropify').dropify();
        $("#offcanvasRight").click();
        $('#originalprice').removeAttr('required').attr('disabled',true).val('');
        $('#profitpercentage').removeAttr('required').attr('disabled',true).val('');
        $('#sellingprice').removeAttr('required').attr('disabled',true).val('');
        $('#profit').removeAttr('required').attr('disabled',true).val('');
        $('#stocks').removeAttr('required').attr('disabled',true).val('');
        $('#discount').removeAttr('required').attr('disabled',true).val('');
        $("#offcanvasRight").click();
    }

    $(function () {
        $('body').on('keyup','.original_price',function (e) {
            e.preventDefault();
            const id = $(this).data('type');
            const originalPriceId     = '#original_price'+id+'';
            const profit_percentageId = '#profit_percentage'+id+'';
            const profitId            = '#profit'+id+'';
            const priceId             = '#price'+id+'';
            const discountID            = '#discount'+id+'';

            const cp = $(this).val();
            let ppercent = $(profit_percentageId).val();
            let discountPercentage = $(discountID).val();
            console.log(ppercent);
            ppercent = (!ppercent.trim()) ? 0 : parseInt(ppercent);
            discountPercentage = (!discountPercentage.trim()) ? 0 : parseInt(discountPercentage);
            const profit = (ppercent !== 0) ? (cp*(ppercent/100)) : ppercent ;
            const discount = (discountPercentage !== 0) ? (cp*(discountPercentage/100)) : ppercent ;
            let sp = (ppercent !== 0) ? parseInt(cp) + (cp*(ppercent/100)) : cp ;
            // sp = (discountPercentage !== 0) ? parseInt(sp) + Math.round((sp*100)/(100-discountPercentage)) : sp ;
            $(priceId).prop('value',sp);
            $(profitId).prop('value',profit);
        });
        $('body').on('keyup','.profit_percentage',function (e) {
            e.preventDefault();
            const id = $(this).data('type');
            const originalPriceId     = '#original_price'+id+'';
            const profit_percentageId = '#profit_percentage'+id+'';
            const profitId            = '#profit'+id+'';
            const priceId             = '#price'+id+'';
            const discountID            = '#discount'+id+'';
            const cp = $(originalPriceId).val();
            let discountPercentage = $(discountID).val();

            let ppercent = $(this).val();
            ppercent = (!ppercent.trim()) ? 0 : parseInt(ppercent);
            discountPercentage = (!discountPercentage.trim()) ? 0 : parseInt(discountPercentage);

            let profit = (ppercent !== 0) ? cp*(ppercent/100) : ppercent ;

            let sp = (ppercent !== 0) ? (parseInt(cp) + profit) : cp ;
            // sp = (discountPercentage !== 0) ? Math.round((sp*100)/(100-discountPercentage)) : sp ;
            $(priceId).prop('value',sp);
            $(profitId).prop('value',profit);
        });
        $('body').on('keyup','.discount',function (e) {
            e.preventDefault();
            const id = $(this).data('type');
            const originalPriceId     = '#original_price'+id+'';
            const profit_percentageId = '#profit_percentage'+id+'';
            const profitId            = '#profit'+id+'';
            const priceId             = '#price'+id+'';
            const discountID            = '#discount'+id+'';

            const cp = $(originalPriceId).val();
            let discountPercentage = $(this).val();

            let ppercent = $(profit_percentageId).val();
            ppercent = (!ppercent.trim()) ? 0 : parseInt(ppercent);
            discountPercentage = (!discountPercentage.trim()) ? 0 : parseInt(discountPercentage);

            let profit = (ppercent !== 0) ? cp*(ppercent/100) : ppercent ;

            let sp = (ppercent !== 0) ? (parseInt(cp) + profit) : cp ;
            // sp = (discountPercentage !== 0) ? Math.round((sp*100)/(100-discountPercentage)) : sp ;
            $(priceId).prop('value',sp);
            $(profitId).prop('value',profit);
        });
        $('body').on('blur','.original_price',function (e) {
            e.preventDefault();
            const id = $(this).data('type');
            const originalPriceId     = '#original_price'+id+'';
            const profit_percentageId = '#profit_percentage'+id+'';
            const profitId            = '#profit'+id+'';
            const priceId             = '#price'+id+'';
            const discountID            = '#discount'+id+'';

            const cp = $(this).val();
            let ppercent = $(profit_percentageId).val();
            let discountPercentage = $(discountID).val();
            ppercent = (!ppercent.trim()) ? 0 : parseInt(ppercent);
            discountPercentage = (!discountPercentage.trim()) ? 0 : parseInt(discountPercentage);
            const profit = (ppercent !== 0) ? (cp*(ppercent/100)) : ppercent ;
            const discount = (discountPercentage !== 0) ? (cp*(discountPercentage/100)) : ppercent ;
            let sp = (ppercent !== 0) ? parseInt(cp) + (cp*(ppercent/100)) : cp ;
            // sp = (discountPercentage !== 0) ? parseInt(sp) + Math.round((sp*100)/(100-discountPercentage)) : sp ;
            $(priceId).prop('value',sp);
            $(profitId).prop('value',profit);
        });
        $('body').on('blur','.profit_percentage',function (e) {
            e.preventDefault();
            const id = $(this).data('type');
            const originalPriceId     = '#original_price'+id+'';
            const profit_percentageId = '#profit_percentage'+id+'';
            const profitId            = '#profit'+id+'';
            const priceId             = '#price'+id+'';
            const discountID            = '#discount'+id+'';

            const cp = $(originalPriceId).val();
            let discountPercentage = $(discountID).val();

            let ppercent = $(this).val();
            ppercent = (!ppercent.trim()) ? 0 : parseInt(ppercent);
            discountPercentage = (!discountPercentage.trim()) ? 0 : parseInt(discountPercentage);

            let profit = (ppercent !== 0) ? cp*(ppercent/100) : ppercent ;

            let sp = (ppercent !== 0) ? (parseInt(cp) + profit) : cp ;
            // sp = (discountPercentage !== 0) ? Math.round((sp*100)/(100-discountPercentage)) : sp ;
            $(priceId).prop('value',sp);
            $(profitId).prop('value',profit);
        });

        $('body').on('blur','.discount',function (e) {
            e.preventDefault();
            const id = $(this).data('type');
            const originalPriceId     = '#original_price'+id+'';
            const profit_percentageId = '#profit_percentage'+id+'';
            const profitId            = '#profit'+id+'';
            const priceId             = '#price'+id+'';
            const discountID            = '#discount'+id+'';

            const cp = $(originalPriceId).val();
            let discountPercentage = $(this).val();

            let ppercent = $(profit_percentageId).val();
            ppercent = (!ppercent.trim()) ? 0 : parseInt(ppercent);
            discountPercentage = (!discountPercentage.trim()) ? 0 : parseInt(discountPercentage);

            let profit = (ppercent !== 0) ? cp*(ppercent/100) : ppercent ;

            let sp = (ppercent !== 0) ? (parseInt(cp) + profit) : cp ;
            // sp = (discountPercentage !== 0) ? Math.round((sp*100)/(100-discountPercentage)) : sp ;
            console.log(sp,'sp');
            $(priceId).prop('value',sp);
            $(profitId).prop('value',profit);
        });
    });



    function variationFailed(data,message)
    {
        if (data !== 0){
            $(data).removeAttr('data-nexttab');
            $('#pills-info-desc-tab').removeAttr('data-bs-target');
            $('#pills-info-desc-tab').attr('disabled', true);
        }

        Toastify({
                newWindow: true,
                text: message,
                gravity: "top",
                position: "center",
                className: "bg-" + "danger",
                stopOnFocus: true,
                duration: 3000,
                close: false,
        }).showToast();
    }

</script>
@endsection
