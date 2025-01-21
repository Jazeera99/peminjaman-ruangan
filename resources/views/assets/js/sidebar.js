document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.querySelector(".sidebar");
    const toggleButton = document.getElementById("toggleSidebar");
  
    console.log("Sidebar:", sidebar);
    console.log("Toggle Button:", toggleButton);
  
    if (!sidebar || !toggleButton) {
      console.error("Sidebar or Toggle Button not found!");
      return;
    }
  
    toggleButton.addEventListener("click", function () {
      sidebar.classList.toggle("collapsed");
    });
  
    document.addEventListener("click", function (e) {
      const isClickInsideSidebar = sidebar.contains(e.target);
      const isClickToggle = toggleButton.contains(e.target);
  
      if (!isClickInsideSidebar && !isClickToggle) {
        sidebar.classList.add("collapsed");
      }
    });
});
  