jQuery(document).ready(function($) {
    // Media Uploader for Gallery
    $('#lth_add_gallery_btn').on('click', function(e) {
        e.preventDefault();
        var frame = wp.media({
            title: 'Chọn hoặc tải ảnh lên',
            button: { text: 'Sử dụng các ảnh này' },
            multiple: true
        });

        frame.on('select', function() {
            var selection = frame.state().get('selection');
            var ids = [];
            $('#property_gallery_container').html(''); // Clear the ui

            selection.map(function(attachment) {
                attachment = attachment.toJSON();
                ids.push(attachment.id);
                
                var url = attachment.url; // Use original as fallback
                if(attachment.sizes && attachment.sizes.thumbnail) {
                    url = attachment.sizes.thumbnail.url;
                }
                
                $('#property_gallery_container').append('<div class="lth-gallery-item" data-id="'+attachment.id+'"><img src="'+url+'" /><span class="remove-img" title="Xóa">&times;</span></div>');
            });

            $('#property_gallery_input').val(ids.join(','));
        });

        frame.open();
    });

    // Remove individual image
    $('#property_gallery_container').on('click', '.remove-img', function(){
        $(this).parent('.lth-gallery-item').remove();
        
        var new_ids = [];
        $('#property_gallery_container .lth-gallery-item').each(function(){
            new_ids.push( $(this).data('id') );
        });
        $('#property_gallery_input').val(new_ids.join(','));
    });

    // Conditional Price/Currency fields
    function updateListingFields() {
        var type = $('#lth_listing_type').val();
        var $priceLabel = $('#lth_price_label');
        var $currencySelect = $('#lth_currency_select');
        
        if (type === 'sale') {
            $priceLabel.text('Giá bán');
            $currencySelect.find('option').each(function(){
                var val = $(this).val();
                if (val === 'billion' || val === 'million' || val === 'million_sqm') {
                    $(this).show().prop('disabled', false);
                } else {
                    $(this).hide().prop('disabled', true);
                }
            });
        } else if (type === 'rent') {
            $priceLabel.text('Giá thuê');
            $currencySelect.find('option').each(function(){
                var val = $(this).val();
                if (val === 'million_month' || val === 'million_year') {
                    $(this).show().prop('disabled', false);
                } else {
                    $(this).hide().prop('disabled', true);
                }
            });
        }
    }

    $('#lth_listing_type').on('change', updateListingFields);
    updateListingFields(); // Init on load

    // Dynamic Property Type Logic
    function updatePropertyTypeFields() {
        var $selected = $('#lth_property_type_sync option:selected');
        if (!$selected.length) return;
        
        var typeText = ($selected.text() || "").toLowerCase();
        var typeSlug = ($selected.data('slug') || "").toLowerCase();
        
        var $container = $('#lth_dynamic_fields');
        if (!$container.length) return;

        // Hide all first
        $container.find('.lth-meta-field').hide();
        
        // Always show direction
        $('.field-huong').show();
        
        // Keyword matching for robustness
        if (typeText.indexOf('biệt thự') > -1 || typeSlug.indexOf('biet-thu') > -1) {
            $('.field-quy-mo, .field-mat-tien, .field-duong-truoc-nha, .field-phong-ngu, .field-hien-trang, .field-phong-tam, .field-so-tang').show();
        } else if (typeText.indexOf('văn phòng') > -1 || typeSlug.indexOf('van-phong') > -1) {
            $('.field-quy-mo, .field-mat-tien, .field-duong-truoc-nha, .field-hien-trang, .field-thiet-ke, .field-so-tang').show();
        } else if (typeText.indexOf('khách sạn') > -1 || typeText.indexOf('ccmn') > -1 || typeSlug.indexOf('khach-san') > -1) {
            $('.field-quy-mo, .field-mat-tien, .field-phong-ngu, .field-lap-day, .field-hien-trang, .field-phong-tam').show();
        } else if (typeText.indexOf('mặt phố') > -1 || typeSlug.indexOf('mat-pho') > -1) {
            $('.field-quy-mo, .field-mat-tien, .field-hien-trang, .field-so-tang, .field-phong-tam, .field-phong-ngu').show();
        } else if (typeText.indexOf('chung cư') > -1 || typeSlug.indexOf('chung-cu') > -1) {
            $('.field-loai-can, .field-khoang-tang, .field-noi-that, .field-phong-tam, .field-phong-ngu').show();
        } else {
            // Default show some common fields if type unknown
            $container.find('.field-quy-mo, .field-mat-tien, .field-huong, .field-phong-ngu, .field-so-tang, .field-phong-tam').show();
        }
    }

    $('#lth_property_type_sync').on('change', function() {
        var termId = $(this).val();
        // Sync with taxonomy box if exists
        if ($('#property-typechecklist input[value="' + termId + '"]').length) {
            $('#property-typechecklist input').prop('checked', false);
            $('#property-typechecklist input[value="' + termId + '"]').prop('checked', true);
        }
        updatePropertyTypeFields();
    });

    updatePropertyTypeFields();
});
