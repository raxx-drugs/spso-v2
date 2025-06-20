<div class="modal fade" id="<?= esc($modalId) ?>" tabindex="-1" aria-labelledby="<?= esc($modalIdLabel) ?>"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">

      <form id="<?= esc($formId) ?>" method="post" action="<?= base_url(esc($api)) ?>" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="<?= esc($modalId) ?>Label"><?= esc($modalTitle) ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <?= isset($modalBodyView) ? view($modalBodyView) : '<div class="text-danger">No form view provided.</div>' ?>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="submitBtn">
            <span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status" aria-hidden="true"></span>
            Save changes
          </button>
        </div>
      </form>

    </div>
  </div>
</div>

