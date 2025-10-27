// Global Bootstrap modals helper
(function(){
    // Inject modal HTML once
    const existing = document.getElementById('globalModalContainer');
    if (!existing) {
        const container = document.createElement('div');
        container.id = 'globalModalContainer';
        container.innerHTML = `
        <!-- Alert Modal -->
        <div class="modal fade" id="bsAlertModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="bsAlertTitle">Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="bsAlertBody"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="bsAlertOk">OK</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Confirm Modal -->
        <div class="modal fade" id="bsConfirmModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="bsConfirmTitle">Please confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="bsConfirmBody"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="bsConfirmCancel">Cancel</button>
                <button type="button" class="btn btn-primary" id="bsConfirmOk">OK</button>
              </div>
            </div>
          </div>
        </div>
        `;
        document.body.appendChild(container);

        // Wire up buttons
        const alertOk = container.querySelector('#bsAlertOk');
        const confirmOk = container.querySelector('#bsConfirmOk');
        const confirmCancel = container.querySelector('#bsConfirmCancel');

        // State for promises
        let alertResolve = null;
        let confirmResolve = null;

        alertOk.addEventListener('click', function(){
            const modal = bootstrap.Modal.getInstance(document.getElementById('bsAlertModal'));
            modal && modal.hide();
            if (alertResolve) { alertResolve(); alertResolve = null; }
        });

        confirmOk.addEventListener('click', function(){
            const modal = bootstrap.Modal.getInstance(document.getElementById('bsConfirmModal'));
            modal && modal.hide();
            if (confirmResolve) { confirmResolve(true); confirmResolve = null; }
        });

        confirmCancel.addEventListener('click', function(){
            const modal = bootstrap.Modal.getInstance(document.getElementById('bsConfirmModal'));
            modal && modal.hide();
            if (confirmResolve) { confirmResolve(false); confirmResolve = null; }
        });

        // Expose helpers
        window.showAlert = function(message, title){
            const titleEl = document.getElementById('bsAlertTitle');
            const bodyEl = document.getElementById('bsAlertBody');
            titleEl.textContent = title || 'Notice';
            if (typeof message === 'string') bodyEl.textContent = message;
            else bodyEl.innerHTML = message || '';
            const modalEl = document.getElementById('bsAlertModal');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
            return new Promise(resolve => { alertResolve = resolve; });
        };

        window.showConfirm = function(message, title){
            const titleEl = document.getElementById('bsConfirmTitle');
            const bodyEl = document.getElementById('bsConfirmBody');
            titleEl.textContent = title || 'Please confirm';
            if (typeof message === 'string') bodyEl.textContent = message;
            else bodyEl.innerHTML = message || '';
            const modalEl = document.getElementById('bsConfirmModal');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
            return new Promise(resolve => { confirmResolve = resolve; });
        };
    }
})();

// Backwards-compatible small shim: calls showAlert for window.alert
if (typeof window !== 'undefined') {
    window._nativeAlert = window.alert;
    window.alert = function(msg){
        if (window.showAlert) { window.showAlert(msg); }
        else { window._nativeAlert(msg); }
    };
}

/* Particle-network 'neural' background for login page */
(function(){
  function initNetworkCanvas(canvas) {
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let width = canvas.width = canvas.offsetWidth;
    let height = canvas.height = canvas.offsetHeight;
    const particles = [];
    const count = Math.max(20, Math.floor((width * height) / 50000));

    function rand(min, max){ return Math.random() * (max - min) + min; }

    function createParticles(){
      particles.length = 0;
      for (let i=0;i<count;i++){
        particles.push({
          x: Math.random()*width,
          y: Math.random()*height,
          vx: rand(-0.3,0.3),
          vy: rand(-0.3,0.3),
          r: rand(0.6,1.6)
        });
      }
    }

    function resize(){
      width = canvas.width = canvas.offsetWidth;
      height = canvas.height = canvas.offsetHeight;
      createParticles();
    }

    window.addEventListener('resize', function(){ resize(); });

    function draw(){
      ctx.clearRect(0,0,width,height);
      // draw lines
      for (let i=0;i<particles.length;i++){
        const p = particles[i];
        for (let j=i+1;j<particles.length;j++){
          const q = particles[j];
          const dx = p.x-q.x, dy = p.y-q.y;
          const d2 = dx*dx+dy*dy;
          if (d2 < 15000){
            const alpha = 0.2*(1 - d2/15000);
            ctx.beginPath();
            ctx.strokeStyle = `rgba(43,130,196,${alpha})`;
            ctx.lineWidth = 0.8;
            ctx.moveTo(p.x,p.y);
            ctx.lineTo(q.x,q.y);
            ctx.stroke();
          }
        }
      }
      // draw particles
      for (let i=0;i<particles.length;i++){
        const p = particles[i];
        ctx.beginPath();
        ctx.fillStyle = 'rgba(43,130,196,0.95)';
        ctx.arc(p.x,p.y,p.r,0,Math.PI*2);
        ctx.fill();
        p.x += p.vx; p.y += p.vy;
        if (p.x < 0 || p.x > width) p.vx *= -1;
        if (p.y < 0 || p.y > height) p.vy *= -1;
      }
      requestAnimationFrame(draw);
    }

    createParticles();
    draw();
  }

  // init on pages that have #loginForm or body.login-page
  document.addEventListener('DOMContentLoaded', function(){
    try {
      const canvas = document.getElementById('networkCanvas');
      if (canvas) initNetworkCanvas(canvas);
    } catch(e){/* ignore */}
  });
})();
