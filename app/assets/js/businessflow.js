$(function () {
    const dummyUsers = [
        { username: "Alice", uid: 1 },
        { username: "Bob", uid: 2 },
        { username: "Charlie", uid: 3 },
        { username: "David", uid: 4 },
        { username: "Eve", uid: 5 },
        { username: "Frank", uid: 6 },
        { username: "Grace", uid: 7 },
        { username: "Hannah", uid: 8 },
        { username: "Ivy", uid: 9 },
        { username: "John", uid: 10 }
    ];

    // Debounce timer
    let debounceTimeout;

    // jQuery function to filter users with debounce
    function filterUsers() {
        const input = $("#myInput").val().toLowerCase();
        const $dropdown = $("#userDropdown");
        $dropdown.empty(); // Clear existing options
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
            $.post("../exec/businessflow/filterusername.php", { data: input }, function (response) {

                consolog.log(response)
                return

                try {
                    const users = JSON.parse(response);
                    users.forEach(user => {
                        dropdown.innerHTML += `<option value="${user.username}" name="${user.uid}">${user.username}</option>`;
                    });
                    dropdown.style.display = input && users.length ? "block" : "none";
                } catch (e) {
                    console.error("Error parsing response:", e);
                }
            }).fail((xhr, status, error) => console.error("Request failed:", status, error));
        }, 300); // Adjust de
    }

    // jQuery function to handle user selection
    function selectUser() {
        const selectedValue = $("#userDropdown").val();
        $("#myInput").val(selectedValue);
        $("#userDropdown").hide();
    }

    $(document).ready(function() {
        $("#myInput").on("keyup", filterUsers);
        $("#userDropdown").on("click", selectUser);
    });
  //NOTE -
  ////////////// TRANSACTION MANAGEMENT-//////////

  $(document).on("click", ".refresh", function(event) {
    event.preventDefault();
    $("#loader").css("display", "flex");
    return false
    const flag = "refresh";
          
    $.ajax({
        url: "../controller/businessflow/tfilter",
        type: "POST",
        data: { flag:flag},
        beforeSend: function(){
      
        },
        success: function(response){
          response = JSON.parse(response);
          $("#filters-container").find("input , select").val('');
          try{
          let rowsMarkup = '';
          response.forEach(element => {
            rowsMarkup += accTransacsMarkup(element);
          }); 
        $("#promotion-dtholder").html(rowsMarkup);
            
        }catch (e) {
            console.log();
            
        }
        },
        error: function(xhr,status,error){
          
        },
        complete: function(){
          $("#loader").css("display", "none");
        },
});

});
})