<!-- Delete  Product Modal Box Start -->
<div class="modal fade theme-modal remove-coupon" id="deleteProduct" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header d-block text-center">
        <h5 class="modal-title w-100" id="deleteUserModalLabel">Delete User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this user?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">Cancel</button>
        <button
        @click="deleteProduct"
          type="button"
          class="btn btn-animation btn-md fw-bold"
          data-bs-target="#exampleModalToggle2"
          data-bs-toggle="modal"
          data-bs-dismiss="modal"
        >
          Delete
        </button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade theme-modal remove-coupon" id="exampleModalToggle2" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel12">Done!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="remove-box text-center">
          <div class="wrapper">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
              <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
              <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>
          </div>
          <h4 class="text-content">It's Removed.</h4>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Delete Product Modal Box End -->

<!-- Edit Product Modal Box Start -->
<div class="modal fade theme-modal edit-product" id="editProduct" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header d-block text-center">
        <h5 class="modal-title w-100" id="exampleModalLabel22">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="edit-box">
          <div class="form-group">
            <label for="editQuantity">Quantity:</label>
            <input type="number" class="form-control" id="editQuantity" placeholder="Enter quantity" v-model="editQuantity">
          </div>
          <div class="form-group">
            <label for="editPrice">Price:</label>
            <input type="number" class="form-control" id="editPrice" placeholder="Enter price" v-model="editPrice">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">Cancel</button>
        <button
          @click="saveChanges"
          type="button"
          class="btn btn-animation btn-md fw-bold"
          data-bs-target="#editProductConfirmation"
          data-bs-toggle="modal"
          data-bs-dismiss="modal"
        >
          Save Changes
        </button>
      </div>
    </div>
  </div>
</div>

<!-- <div class="modal fade theme-modal edit-product-confirmation" id="editProductConfirmation" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel12">Changes Saved!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="edit-box-confirmation text-center">
          <div class="wrapper">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
              <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
              <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>
          </div>
          <h4 class="text-content">Changes have been saved.</h4>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->
<!-- Edit Modal Box End -->


<!-- Delete User  Modal Box Start -->
<div class="modal fade theme-modal remove-coupon" id="deleteUser" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header d-block text-center">
        <h5 class="modal-title w-100" id="deleteUserModalLabel">Delete User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this user?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">Cancel</button>
        <button @click="deleteUser"
          type="button"
          class="btn btn-animation btn-md fw-bold"
          data-bs-target="#exam"
          data-bs-toggle="modal"
          data-bs-dismiss="modal"
        >
          Delete
        </button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade theme-modal remove-coupon" id="exam" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel12">Done!</h5>
      </div>
      <div class="modal-body">
        <div class="remove-box text-center">
          <div class="wrapper">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
              <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
              <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>
          </div>
          <h4 class="text-content">Users SuccessFully Deleted.</h4>
        </div>
      </div>
      <div class="modal-footer">
        <button  @click="deleteChanges" class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete User Modal  End -->

<!-- Edit User Modal Box Start -->
<div class="modal fade theme-modal edit-user" id="editUser" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header d-block text-center">
            <h5 class="modal-title w-100" id="editUserModalLabel">Edit User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="edit-box">
              <div class="form-group">
                <label for="editFullname">Full Name:</label>
                <input type="text" class="form-control" id="editFullname" placeholder="Enter full name" v-model="editFullname">
              </div>
              <div class="form-group">
                <label for="editPhone">Phone:</label>
                <input type="text" class="form-control" id="editMobile" placeholder="Enter phone number" v-model="editMobile">
              </div>
              <div class="form-group">
                <label for="editEmail">Email:</label>
                <input type="email" class="form-control" id="editEmail" placeholder="Enter email" v-model="editEmail">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">Cancel</button>
            <button
              @click="saveUserChanges"
              type="button"
              class="btn btn-animation btn-md fw-bold"
              data-bs-target="#editUserConfirmation"
              data-bs-toggle="modal"
              data-bs-dismiss="modal"
            >
              Save Changes
            </button>
          </div>
        </div>
      </div>
    </div>



    <div class="modal fade theme-modal remove-coupon" id="editUserConfirmation" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel12">Done!</h5>
      </div>
      <div class="modal-body">
        <div class="remove-box text-center">
          <div class="wrapper">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
              <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
              <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>
          </div>
          <h4 class="text-content">Users SuccessFully Updated.</h4>
        </div>
      </div>
      <div class="modal-footer">
        <button  @click="SaveChanges" class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit User Modal Box End -->