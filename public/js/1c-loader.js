function loader (css, js) {
    // (A) TOTAL NUMBER OF SCRIPTS
    var total = css.length + js.length,
    now = 0, s;
   
    // (B) READY?
    var ready = () => {
      now++;
      if (now==total) { document.getElementById("loading").remove(); }
    };
   
    // (C) INSERT <LINK> INTO <HEAD>
    css.forEach((url, i) => {
      s = document.createElement("link");
      s.rel = "stylesheet";
      s.href = url;
      s.onload = ready; s.onerror = ready;
      document.head.appendChild(s);
    });
   
    // (D) INSERT <SCRIPT> INTO <HEAD>
    js.forEach((url, i) => {
      s = document.createElement("script");
      s.src = url;
      s.onload = ready; s.onerror = ready;
      document.head.appendChild(s);
    });
  }