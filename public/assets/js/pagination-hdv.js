function getPageList(totalPages, page, maxLength) {
    function range(start, end) {
      return Array.from(Array(end - start + 1), (_, i) => i + start);
    }
  
    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth * 2 - 3) >> 1;
  
    if (totalPages <= maxLength) {
      return range(1, totalPages);
    }
  
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
      return range(1, maxLength - sideWidth - 1).concat(
        0,
        range(totalPages - sideWidth + 1, totalPages)
      );
    }
  
    if (page >= totalPages - sideWidth - 1 - rightWidth) {
      return range(1, sideWidth).concat(
        0,
        range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages)
      );
    }
  
    return range(1, sideWidth).concat(
      0,
      range(page - leftWidth, page + rightWidth),
      0,
      range(totalPages - sideWidth + 1, totalPages)
    );
  }
  
  $(function () {
    var numberOfItems = $(".info-hdv .each-hdv").length;
    var limitPerPage = 8; 
    var totalPages = Math.ceil(numberOfItems / limitPerPage);
    var paginationSize = 4; 
    var currentPage;
  
    function showPage(whichPage) {
      if (whichPage < 1 || whichPage > totalPages) return false;
  
      currentPage = whichPage;
  
      $(".info-hdv .each-hdv")
        .hide()
        .slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage)
        .show();
  
      $(".pagination-custom li").slice(1, -1).remove();
  
      getPageList(totalPages, currentPage, paginationSize).forEach((item) => {
        $("<li>")
          .addClass("page-item-custom")
          .addClass(item ? "current-page-custom" : "dots")
          .toggleClass("active", item === currentPage)
          .append(
            $("<a>")
              .addClass("page-link-custom")
              .attr({ href: "javascript:void(0)" })
              .text(item || "...")
          )
          .insertBefore(".next-page-custom");
      });
  
      $(".previous-page-custom").toggleClass("disable", currentPage === 1);
      $(".next-page-custom").toggleClass("disable", currentPage === totalPages);
      return true;
    }
  
    $(".pagination-custom").append(
      $("<li>")
        .addClass("page-item-custom")
        .addClass("previous-page-custom")
        .append(
          $("<a>")
            .addClass("page-link-custom")
            .attr({ href: "javascript:void(0)" })
            .text("Prev")
        ),
      $("<li>")
        .addClass("page-item-custom")
        .addClass("next-page-custom")
        .append(
          $("<a>")
            .addClass("page-link-custom")
            .attr({ href: "javascript:void(0)" })
            .text("Next")
        )
    );
  
    $(".info-hdv").show();
    showPage(1);
  
    $(document).on(
      "click",
      ".pagination-custom li.current-page-custom:not(.active)",
      function () {
        return showPage(+$(this).text());
      }
    );
  
    $(".next-page-custom").on("click", function () {
      return showPage(currentPage + 1);
    });
  
    $(".previous-page-custom").on("click", function () {
      return showPage(currentPage - 1);
    });
  });
  
  $(function () {
    $(document).ready(function () {
      $(".pagination-custom").click(function () {
        $('html, body').animate(
          {
            scrollTop: 550,
          }, 500
        );
      });
    });
  });