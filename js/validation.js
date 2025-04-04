/**
 * Form validation for the Library Management System
 * This script handles client-side validation for the search form
 */

document.addEventListener('DOMContentLoaded', function() {
    // Get form and form elements
    const searchForm = document.getElementById('searchForm');
    const searchType = document.getElementsByName('searchType');
    const searchQuery = document.getElementById('searchQuery');
    const searchError = document.getElementById('searchError');
    
    // Function to validate the search form
    function validateSearchForm() {
        // Clear previous error messages
        searchError.textContent = '';
        
        // Check if search query is empty
        if (searchQuery.value.trim() === '') {
            searchError.textContent = 'Please enter a search term';
            searchQuery.focus();
            return false;
        }
        
        // Make sure a search type is selected
        let typeSelected = false;
        for (let i = 0; i < searchType.length; i++) {
            if (searchType[i].checked) {
                typeSelected = true;
                break;
            }
        }
        
        if (!typeSelected) {
            searchError.textContent = 'Please select a search type (Author or Genre)';
            return false;
        }
        
        // Validate search query based on type
        const selectedType = document.querySelector('input[name="searchType"]:checked').value;
        
        if (selectedType === 'author') {
            // For author, only allow letters, spaces, and hyphens
            if (!/^[A-Za-z\s\-]+$/.test(searchQuery.value.trim())) {
                searchError.textContent = 'Author name should contain only letters, spaces, and hyphens';
                searchQuery.focus();
                return false;
            }
        } else if (selectedType === 'genre') {
            // For genre, only allow letters and spaces
            if (!/^[A-Za-z\s]+$/.test(searchQuery.value.trim())) {
                searchError.textContent = 'Genre should contain only letters and spaces';
                searchQuery.focus();
                return false;
            }
        }
        
        return true;
    }
    
    // Add form submit event listener
    if (searchForm) {
        searchForm.addEventListener('submit', function(event) {
            // Prevent form submission if validation fails
            if (!validateSearchForm()) {
                event.preventDefault();
            }
        });
    }
    
    // Add input event listener to search query field for real-time validation
    if (searchQuery) {
        searchQuery.addEventListener('input', function() {
            // Clear error message when user starts typing
            searchError.textContent = '';
        });
    }
    
    // Add change event listener to search type radio buttons
    for (let i = 0; i < searchType.length; i++) {
        searchType[i].addEventListener('change', function() {
            // Update placeholder based on selected search type
            if (this.value === 'author') {
                searchQuery.placeholder = 'Enter author name...';
            } else if (this.value === 'genre') {
                searchQuery.placeholder = 'Enter genre...';
            }
        });
    }
});
