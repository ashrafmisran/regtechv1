$('#search').select2({
    placeholder: 'Type account no. / receipt no. / payment no.',
    ajax: {
        url: 'https://api.github.com/search/repositories',
        dataType: 'json',
        data: function(params) {
            var query = {
                search: params.term,
                type: 'public'
            }

            // Query parameters will be ?search=[term]&type=public
            return query;
        },
        processResults: function(data) {
            // Tranforms the top-level key of the response object from 'items' to 'results'
            return {
                results: data.items
            };
        }
    }
});

