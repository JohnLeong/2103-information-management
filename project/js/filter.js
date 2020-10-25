/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function prevPage(currentPage, totalPages) {
    if (currentPage - 1 > 0) {
        document.getElementById("page_num").value = currentPage - 1;
    }
    document.getElementById("filter_form").submit();
}

function nextPage(currentPage, totalPages) {
    if (currentPage + 1 <= totalPages) {
        document.getElementById("page_num").value = currentPage + 1;
    }
    document.getElementById("filter_form").submit();
}