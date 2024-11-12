$(function(){

    const template = (data) => {
        console.log("Big Data" , data)
    
        let html = '';
        data.forEach(item => {
            html += `
                <tr>
                    <td>${item.uid}</td>
                    <td>${item.username}</td>
                    <td>${item.nickname}</td>
                    <td>${item.user_email}</td>
                    <td>${item.user_dob}</td>
                    <td>
                        <button class="btn btn-primary" onclick="viewDetails(${item.uid})">View</button>
                        <button class="btn btn-danger" onclick="deleteRecord(${item.uid})">Delete</button>
                    </td>
                </tr>
            `;
        });
        return html;
    }

    const render = (data) => {
        var html = template(data);
        $('#dataContainer').html(html);
    }

    const fetchUsers = (pageNumber  = 1, limit = 5) => {
        const url = `../admin/homedata/${pageNumber}/${limit}`;
        $.get(url,function(response){
            $('#pagination').pagination({
                dataSource: Array.from({ length: response.total }, (_, i) => i + 1),
                pageNumber: pageNumber,
                pageSize: limit,
                callback: function (data, pagination) {
                    render(response.data);
                }
            });
        })
    }
    fetchUsers() // make first request

})