>Note: This manual is still being written and it is still unfinished.

## Enhanced Document Tracking System for SDOIN


This project aims to improve the current tracking system used in the Schools Division of Ilocos Norte. The eDTS achieves better organization of documents by visualizing your current physical arrayed documents in a user-friendly, digital approach.

This project also aims to optimize the tracking process, enabling bulk releasing and receiving for units with a lot of documents to work on for improved efficiency.

An added feature of the eDTS is the ability for users to scan the documents to automatically receive it without having to type the tracking no. (Typing is still supported)
### Table of Contents
- [Account](#1-account)
    - [Creating an account](#creating-an-account)
    - [Signing in](#signing-in)
    - [Requesting for a new password](#requesting-for-a-new-password)
- [Adding documents](#2-adding-documents)
    - [Tracking number](#tracking-number)
    - [Printing of sdoin-dts tracking number](#printing-of-sdoin-dts-tracking-number)
    - [Uploading digital copies (Only applicable to OSDS, SGOD, CID units)](#uploading-of-documents)
- [Receiving and Releasing](#3-receiving-and-releasing)
    - [Receiving and releasing documents](#receiving-and-releasing-documents)
    - [Scanning barcode to receive document](#scanning-barcode-to-receive-document)
    - [Marking documents as accomplished](#marking-documents-as-accomplished)
- [Report generation](#4-report-generation)
    - [Per-day generation](#per-day-generation)
    - [Date-range generation](#date-range-generation)
    - [Keeping track of all created documents](#keeping-track-of-all-created-documents)

---

## **1. Account**

This section shows the basic overview of an account and how it is used in the system.

### **Creating an account**

Fields needed to create an account is a valid e-mail address, full name, school or unit the account needs to belong in, and a password

- ***e-mail address*** is needed for the system to send you an e-mail when requesting for a password reset
- ***full name*** is required to provide additional data on *who* received or released the document, this eliminates ambiguity in the system and provides much more needed information regarding how the documents are processed.
- ***school or unit*** is a group of users where an account belongs in, multiple users can be in a school or unit, and anyone can receive, release, or create a document *within* the unit

### **Signing in**

This does not need any additional explanation. Although, keep in mind that when signed in and you have been inactive for 25 minutes, you will automatically be logged out for security purposes.

### **Requesting for a new password**

As of April 05, 2022 - the feature to change password has not been implemented yet. However, accounts with forgotten passwords can be recovered through the ***I forgot my password*** button upon signing in.

If you forgot your password, enter your e-mail address on the field and you will receive an auto generated e-mail on how to reset your password, please check if you typed your e-mail correctly and check your spam or trash folders on your e-mail service provider. You will receive an e-mail instantly, if not - try again within a few minutes.


## **2. Adding documents**

Adding documents can only be done when a user is logged in. It is found on the left sidebar menu on the user's dashboard.
- Fields needed to add a document are as follows:
    - Document title
    - Description
    - Document type
    - Release to
    - Purpose / Remarks

Office origin, and the date of document creation are automatically generated.

### **Tracking number**

Tracking no. is used to track documents and it shows which office currently holds said document. Here is what a typical tracking number looks like:

`4522-101698`

Notice that there are 2 parts on the tracking number. The first part which is separated by a dash (-), shows the date of when the document is created in the format `MMDDYY`. In this case, the document is created during the 5<sup>th</sup> of April in the year 2022 (4522), leading zeroes are omitted to keep the tracking number clean and compact. The second part is just a random 6 digit identifer. Tables displayed in the system are searchable, users are able to search for a tracking number with only the 6 digit identifier, the date is just there to provide instant information on when it was created.

Upon document creation, an alert message will show on whatever page you are on below the page title. You can then write the tracking number on the physical document, or you can click on it, which leads us to the next item, printing of the tracking number.

### **Printing of sdoin-dts tracking number**

Printing of the document tracking number opens up a new tab, and a print preview. The placement of the tracking number and the barcode are at the top right corner of the page.

> This is the ideal process on how to print the tracking number on a physical copy of the document.
>
>```
>1. Print the document
>2. Insert the first page of the document back into the printer
>3. Create a tracking number using the system
>4. Print the tracking number on the first page of said document
>```

### **Uploading of Documents**

This section is inteded for accounts under the units *``OSDS OFFICE``, ``SGOD Chief``, ``CID Chief``*

The only allowed documents for upload are those for dissemination **only**. 

Filetype supported: ``PDF``, maximum file size is 10MB.


## **3. Receiving and Releasing**

Receiving and releasing is the main focus of this project, it provides data on how documents are being processed and also provides a map of when and where documents are received.

### **Receiving and releasing documents**

The table view for receiving and releasing documents is found on the left sidebar menu on the user's dashboard. The table consist of 3 columns:
- Checkbox
    - This allows the user to select a multiple documents to receive or release at once.
- Document title
- Action
    - The receiving table only has a receive action, while the release table has 2 actions:
        - Release
        - Mark as accomplished
> **Note:** Mark as accomplished is only available for documents that are already received.
> Marking multiple documents as accomplished is not supported as this action is irreversible.


### **Scanning barcode to receive document**

Scanning to receive is supported, in this page, a textbox is provided to read the code from the scanner. When scanning, make sure the *caret* is on the textbox for proper functionality. Along with this, a quick release table is provided, which allows the user to quickly release the document if needed.


### **Marking documents as accomplished**

This function is mainly used for the purpose of making the release table **clean**, by removing completed documents from the table and putting them in a different table.

## **4. Report generation**
### **Per-day generation**
### **Date-range generation**
### **Keeping track of all created documents**


---
#### This manual is written by Louis Velasco