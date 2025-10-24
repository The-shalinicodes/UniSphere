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
