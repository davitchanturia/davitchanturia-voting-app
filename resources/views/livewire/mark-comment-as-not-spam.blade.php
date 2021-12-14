<x-modal-confirm 
  livewire-event-to-open-modal="MarkAsNotSpamCommentWasSet"  
  event-to-close-modal="commentWasMarkedAsNotSpam"           
  modal-title="Reset Spam Counter"                      
  modal-description="Are you sure you want to mark this comment as not spam? This will reset the spam counter to 0."    
  modal-confirm-button-text="Reset Spam Counter"         
  wire-click="markAsNotSpam"                     
/>