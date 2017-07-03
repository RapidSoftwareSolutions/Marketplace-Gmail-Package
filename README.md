[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/Gmail/functions?utm_source=RapidAPIGitHub_GmailFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# Gmail Package
Gmail
* Domain: [Gmail](http://gmail.com)
* Credentials: apiKey

## How to get credentials: 
0. Item one 
1. Item two 



## Custom datatypes: 
 |Datatype|Description|Example
 |--------|-----------|----------
 |Datepicker|String which includes date and time|```2016-05-28 00:00:00```
 |Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
 |List|Simple array|```["123", "sample"]``` 
 |Select|String with predefined values|```sample```
 |Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ```
 

## Gmail.getProfile
Gets the current user's Gmail profile.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.stopMailboxNotifications
Stop receiving push notifications for the given user mailbox.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.setMailboxNotification
Set up or update a push notification watch on the given user mailbox.

| Field            | Type  | Description
|------------------|-------|----------
| accessToken      | String| Token received from Gmail
| topicName        | String| A fully qualified Google Cloud Pub/Sub API topic name to publish the events to. This topic name **must** already exist in Cloud Pub/Sub and you **must** have already granted gmail "publish" permission on it. For example, "projects/my-project-identifier/topics/my-topic-name" (using the Cloud Pub/Sub "v1" topic naming format).
| email            | String| The email of the user. The special value me can be used to indicate the authenticated user.
| labelFilterAction| Select| Filtering behavior of labelIds list specified. 
| labelIds         | List  | List of label_ids to restrict notifications about. By default, if unspecified, all changes are pushed out. If specified then dictates which labels are required for a push notification to be generated.

## Gmail.createDraft
Creates a new draft

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| message    | String  | The entire draft message in an RFC 2822 formatted and base64url encoded string.
| id         | String| Id of the draft
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.getSingleDraft
Get single draft

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| draftId    | String| Id of the draft
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.getDrafts
Get all drafts

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.updateDraft
Update existing draft

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| draftId    | String| Id of the draft
| message    | String  | The entire draft message in an RFC 2822 formatted and base64url encoded string.
| id         | String| Id of the draft
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.sendDraft
Send existing draft

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| draftId    | String| Id of the draft
| message    | String  | The entire draft message in an RFC 2822 formatted and base64url encoded string.
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.deleteDraft
Delete single draft

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| draftId    | String| Id of the draft
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.createLabel
Creates a new label

| Field                | Type  | Description
|----------------------|-------|----------
| accessToken          | String| Token received from Gmail
| labelName            | String| The display name of the label.
| labelListVisibility  | Select| The visibility of the label in the label list in the Gmail web interface. 
| messageListVisibility| Select| The visibility of messages with this label in the message list in the Gmail web interface. 
| email                | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.getLabels
Get all labels

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.getSingleLabel
Get single label

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| labelId    | String| Id of the label
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.updateLabel
Update single label

| Field                | Type  | Description
|----------------------|-------|----------
| accessToken          | String| Token received from Gmail
| labelId              | String| Id of the label
| email                | String| The email of the user. The special value me can be used to indicate the authenticated user.
| labelName            | String| The display name of the label.
| labelListVisibility  | Select| The visibility of the label in the label list in the Gmail web interface. 
| messageListVisibility| Select| The visibility of messages with this label in the message list in the Gmail web interface. 

## Gmail.deleteLabel
Delete single label

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| labelId    | String| Id of the label
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.getMailboxMessages
Lists the messages in the user's mailbox

| Field           | Type  | Description
|-----------------|-------|----------
| accessToken     | String| Token received from Gmail
| labelIds        | List  | Only return messages with labels that match all of the specified label IDs.
| email           | String| The email of the user. The special value me can be used to indicate the authenticated user.
| includeSpamTrash| String| Include messages from SPAM and TRASH in the results
| maxResults      | Number| Maximum number of messages to return.
| pageToken       | String| Page token to retrieve a specific page of results in the list.
| q               | String| Only return messages matching the specified query. Supports the same query format as the Gmail search box. For example, "from:someuser@example.com rfc822msgid: is:unread". 

## Gmail.insertMessageIntoMailbox
Directly inserts a message into only this user's mailbox similar to IMAP APPEND, bypassing most scanning and classification. Does not send a message.

| Field             | Type  | Description
|-------------------|-------|----------
| accessToken       | String| Token received from Gmail
| raw               | String| The entire email message in an RFC 2822 formatted and base64url encoded string. Returned in messages.get and drafts.get responses when the format=RAW parameter is supplied.
| email             | String| The email of the user. The special value me can be used to indicate the authenticated user.
| internalDateSource| Select| Source for Gmail's internal date of the message. 
| internalDate      | String| Message internal date
| labelIds          | List  | Only return messages with labels that match all of the specified label IDs.
| historyId         | String| Message history Id
| id                | String| Message Id
| payload           | JSON  | Message payload
| sizeEstimate      | Number| Message estimated size
| snippet           | String| Message snippet
| threadId          | String| Message thread id

## Gmail.getSingleMailboxMessage
Get single message

| Field          | Type  | Description
|----------------|-------|----------
| accessToken    | String| Token received from Gmail
| messageId      | String| Id of the message
| email          | String| The email of the user. The special value me can be used to indicate the authenticated user.
| metadataHeaders| String| When given and format is METADATA, only include headers specified.
| format         | Select| When given and format is METADATA, only include headers specified.

## Gmail.deleteSingleMailboxMessage
Delete single message

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| messageId  | String| Id of the message
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.updateLabelsOnMessage
Update labels on single message

| Field         | Type  | Description
|---------------|-------|----------
| accessToken   | String| Token received from Gmail
| messageId     | String| Id of the message
| email         | String| The email of the user. The special value me can be used to indicate the authenticated user.
| addLabelIds   | List  | Labels to add
| removeLabelIds| List  | Labels to remove

## Gmail.sendMessage
Sends the specified message to the recipients in the To, Cc, and Bcc headers.

| Field             | Type  | Description
|-------------------|-------|----------
| accessToken       | String| Token received from Gmail
| raw               | String| The entire email message in an RFC 2822 formatted and base64url encoded string. Returned in messages.get and drafts.get responses when the format=RAW parameter is supplied.
| email             | String| The email of the user. The special value me can be used to indicate the authenticated user.
| internalDateSource| Select| Source for Gmail's internal date of the message. 
| labelIds          | List  | Only return messages with labels that match all of the specified label IDs.
| historyId         | String| Message history Id
| id                | String| Message Id
| internalDate      | String| Message internal date
| payload           | JSON  | Message payload
| sizeEstimate      | Number| Message estimated size
| snippet           | String| Message snippet
| threadId          | String| Message thread id

## Gmail.moveMessageToTrash
Move single message to trash

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| messageId  | String| Id of the message
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.removeMessageFromTrash
Remove single message from trash

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| messageId  | String| Id of the message
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.importMessageIntoMailbox
Imports a message into only this user's mailbox, with standard email delivery scanning and classification similar to receiving via SMTP. Does not send a message.

| Field             | Type   | Description
|-------------------|--------|----------
| accessToken       | String | Token received from Gmail
| raw               | String | The entire email message in an RFC 2822 formatted and base64url encoded string. Returned in messages.get and drafts.get responses when the format=RAW parameter is supplied.
| email             | String | The email of the user. The special value me can be used to indicate the authenticated user.
| deleted           | Boolean| Mark the email as permanently deleted (not TRASH) and only visible in Google Vault to a Vault administrator. Only used for G Suite accounts. 
| neverMarkSpam     | Boolean| Ignore the Gmail spam classifier decision and never mark this email as SPAM in the mailbox.
| processForCalendar| Boolean| Process calendar invites in the email and add any extracted meetings to the Google Calendar for this user.
| internalDateSource| Select | Source for Gmail's internal date of the message. 
| labelIds          | List   | Only return messages with labels that match all of the specified label IDs.
| historyId         | String | Message history Id
| id                | String | Message Id
| internalDate      | String | Message internal date
| payload           | JSON   | Message payload
| sizeEstimate      | Number | Message estimated size
| snippet           | String | Message snippet
| threadId          | String | Message thread id

## Gmail.batchMessageDelete
Delete several messages

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| ids        | List  | Ids of the message
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.batchLabelsModify
Modifies the labels on the specified messages.

| Field         | Type  | Description
|---------------|-------|----------
| accessToken   | String| Token received from Gmail
| ids           | List  | Ids of the message
| email         | String| The email of the user. The special value me can be used to indicate the authenticated user.
| addLabelIds   | List  | Labels to add
| removeLabelIds| List  | Labels to remove

## Gmail.getSingleMessageAttachment
Get single message attachment

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Token received from Gmail
| messageId   | String| Id of the message
| attachmentId| String| Id of the attachment
| email       | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.getSingleThread
Get single thread

| Field          | Type  | Description
|----------------|-------|----------
| accessToken    | String| Token received from Gmail
| threadId       | String| Id of the thread
| email          | String| The email of the user. The special value me can be used to indicate the authenticated user.
| metadataHeaders| String| When given and format is METADATA, only include headers specified.
| format         | Select| When given and format is METADATA, only include headers specified.

## Gmail.getThreads
Lists the threads in the user's mailbox

| Field           | Type  | Description
|-----------------|-------|----------
| accessToken     | String| Token received from Gmail
| labelIds        | List  | Only return threads with labels that match all of the specified label IDs.
| email           | String| The email of the user. The special value me can be used to indicate the authenticated user.
| includeSpamTrash| String| Include threads from SPAM and TRASH in the results
| maxResults      | Number| Maximum number of messages to return.
| pageToken       | String| Page token to retrieve a specific page of results in the list.
| q               | String| Only return messages matching the specified query. Supports the same query format as the Gmail search box. For example, "from:someuser@example.com rfc822msgid: is:unread". 

## Gmail.updateThreadLabels
Update labels on single thread

| Field         | Type  | Description
|---------------|-------|----------
| accessToken   | String| Token received from Gmail
| threadId      | String| Id of the thread
| email         | String| The email of the user. The special value me can be used to indicate the authenticated user.
| addLabelIds   | List  | Labels to add
| removeLabelIds| List  | Labels to remove

## Gmail.deleteThread
Delete single thread

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| threadId   | String| Id of the thread
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.moveThreadToTrash
Move single thread to trash

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| threadId   | String| Id of the thread
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.untrashThread
Remove single thread from trash

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| threadId   | String| Id of the thread
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.getAutoForwarding
Gets the auto-forwarding setting for the specified account.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.getImapSettings
Gets IMAP settings.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.getPopSettings
Gets POP settings.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.updateAutoForwarding
Updates the auto-forwarding setting for the specified account. A verified forwarding address must be specified when auto-forwarding is enabled. 

| Field       | Type   | Description
|-------------|--------|----------
| accessToken | String | Token received from Gmail
| email       | String | The email of the user. The special value me can be used to indicate the authenticated user.
| enabled     | Boolean| Whether all incoming mail is automatically forwarded to another address.
| emailAddress| Boolean| Email address to which all incoming messages are forwarded. This email address must be a verified member of the forwarding addresses.
| disposition | Select | The state that a message should be left in after it has been forwarded.

## Gmail.updateImapSettings
Updates IMAP settings.

| Field          | Type   | Description
|----------------|--------|----------
| accessToken    | String | Token received from Gmail
| email          | String | The email of the user. The special value me can be used to indicate the authenticated user.
| enabled        | Boolean| Whether IMAP is enabled for the account.
| maxFolderSize  | Number | An optional limit on the number of messages that an IMAP folder may contain. Legal values are 0, 1000, 2000, 5000 or 10000. A value of zero is interpreted to mean that there is no limit.
| expungeBehavior| Select | The action that will be executed on a message when it is marked as deleted and expunged from the last visible IMAP folder. 
| autoExpunge    | Boolean| If this value is true, Gmail will immediately expunge a message when it is marked as deleted in IMAP. Otherwise, Gmail will wait for an update from the client before expunging messages marked as deleted.

## Gmail.updatePopSettings
Updates POP settings.

| Field       | Type   | Description
|-------------|--------|----------
| accessToken | String | Token received from Gmail
| email       | String | The email of the user. The special value me can be used to indicate the authenticated user.
| emailAddress| Boolean| Email address to which all incoming messages are forwarded. This email address must be a verified member of the forwarding addresses.
| disposition | Select | The action that will be executed on a message after it has been fetched via POP.
| accessWindow| Select | The range of messages which are accessible via POP. 

## Gmail.getVacationSettings
Gets vacation responder settings.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.updateVacationSettings
Updates vacation responder settings.

| Field                | Type      | Description
|----------------------|-----------|----------
| accessToken          | String    | Token received from Gmail
| email                | String    | The email of the user. The special value me can be used to indicate the authenticated user.
| enableAutoReply      | Boolean   | Flag that controls whether Gmail automatically replies to messages.
| responseSubject      | String    | Optional text to prepend to the subject line in vacation responses. In order to enable auto-replies, either the response subject or the response body must be nonempty.
| responseBodyPlainText| String    | Response body in plain text format.
| responseBodyHtml     | String    | Response body in HTML format. Gmail will sanitize the HTML before storing it.
| restrictToContacts   | Boolean   | Flag that determines whether responses are sent to recipients who are not in the user's list of contacts.
| restrictToDomain     | Boolean   | Flag that determines whether responses are sent to recipients who are outside of the user's domain. This feature is only available for G Suite users.
| startTime            | DatePicker| An optional start time for sending auto-replies (Y-m-d H:m:s). When this is specified, Gmail will automatically reply only to messages that it receives after the start time. If both startTime and endTime are specified, startTime must precede endTime.
| endTime              | DatePicker| An optional end time for sending auto-replies (Y-m-d H:m:s). When this is specified, Gmail will automatically reply only to messages that it receives before the end time. If both startTime and endTime are specified, startTime must precede endTime.

## Gmail.getForwardingAddresses
Lists the forwarding addresses for the specified account.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.getForwardingAddresses
Lists the forwarding addresses for the specified account.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.createForwardingAddress
Creates a forwarding address.

| Field          | Type  | Description
|----------------|-------|----------
| accessToken    | String| Token received from Gmail
| email          | String| The email of the user. The special value me can be used to indicate the authenticated user.
| forwardingEmail| String| The forwarding address to be set.

## Gmail.getForwardingAddress
Gets the specified forwarding address. 

| Field          | Type  | Description
|----------------|-------|----------
| accessToken    | String| Token received from Gmail
| email          | String| The email of the user. The special value me can be used to indicate the authenticated user.
| forwardingEmail| String| The forwarding address to be retrieved.

## Gmail.deleteForwardingAddress
Deletes the specified forwarding address. 

| Field          | Type  | Description
|----------------|-------|----------
| accessToken    | String| Token received from Gmail
| email          | String| The email of the user. The special value me can be used to indicate the authenticated user.
| forwardingEmail| String| The forwarding address to be deleted.

## Gmail.createFilter
Creates a filter

| Field         | Type   | Description
|---------------|--------|----------
| accessToken   | String | Token received from Gmail
| email         | String | The email of the user. The special value me can be used to indicate the authenticated user.
| addLabelIds   | List   | Labels to add
| removeLabelIds| List   | Labels to remove
| forward       | String | Email address that the message should be forwarded to.
| excludeChats  | Boolean| Whether the response should exclude chats.
| from          | String | The sender's display name or email address.
| hasAttachment | Boolean| Whether the message has any attachment.
| negatedQuery  | JSON   | Only return messages not matching the specified query. Supports the same query format as the Gmail search box. For example, "from:someuser@example.com rfc822msgid: is:unread".
| query         | JSON   | Only return messages matching the specified query. Supports the same query format as the Gmail search box. For example, "from:someuser@example.com rfc822msgid: is:unread".
| size          | Number | The size of the entire RFC822 message in bytes, including all headers and attachments.
| sizeComparison| Select | How the message size in bytes should be in relation to the size field. 
| subject       | String | Case-insensitive phrase found in the message's subject. Trailing and leading whitespace are be trimmed and adjacent spaces are collapsed.
| to            | String | The recipient's display name or email address. Includes recipients in the "to", "cc", and "bcc" header fields. You can use simply the local part of the email address. For example, "example" and "example@" both match "example@gmail.com". This field is case-insensitive.

## Gmail.getFilters
Get all filters

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.getSingleFilter
Get single filter

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| filterId   | String| Id of the filter
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.deleteFilter
Delete single filter

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| filterId   | String| Id of the filter
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.createSendAsAlias
Creates a custom "from" send-as alias.

| Field         | Type   | Description
|---------------|--------|----------
| accessToken   | String | Token received from Gmail
| email         | String | The email of the user. The special value me can be used to indicate the authenticated user.
| sendAsEmail   | String | An optional email address that is included in a "Reply-To:" header for mail sent using this alias. If this is empty, Gmail will not generate a "Reply-To:" header.
| displayName   | String | A name that appears in the "From:" header for mail sent using this alias. For custom "from" addresses, when this is empty, Gmail will populate the "From:" header with the name that is used for the primary address associated with the account.
| isDefault     | Boolean| Whether this address is selected as the default
| replyToAddress| String | An optional email address that is included in a "Reply-To:" header for mail sent using this alias. If this is empty, Gmail will not generate a "Reply-To:" header.
| signature     | String | An optional HTML signature that is included in messages composed with this alias in the Gmail web UI.
| host          | String | The hostname of the SMTP service.
| password      | String | The password that will be used for authentication with the SMTP service.
| port          | Number | The port of the SMTP service.
| securityMode  | Select | The protocol that will be used to secure communication with the SMTP service.
| username      | String | The username that will be used for authentication with the SMTP service. 
| treatAsAlias  | Boolean| Whether Gmail should treat this address as an alias for the user's primary email address. This setting only applies to custom "from" aliases.

## Gmail.updateSendAsAlias
Updates a custom "from" send-as alias.

| Field         | Type   | Description
|---------------|--------|----------
| accessToken   | String | Token received from Gmail
| email         | String | The email of the user. The special value me can be used to indicate the authenticated user.
| sendAsEmail   | String | An optional email address that is included in a "Reply-To:" header for mail sent using this alias. If this is empty, Gmail will not generate a "Reply-To:" header.
| displayName   | String | A name that appears in the "From:" header for mail sent using this alias. For custom "from" addresses, when this is empty, Gmail will populate the "From:" header with the name that is used for the primary address associated with the account.
| isDefault     | Boolean| Whether this address is selected as the default
| replyToAddress| String | An optional email address that is included in a "Reply-To:" header for mail sent using this alias. If this is empty, Gmail will not generate a "Reply-To:" header.
| signature     | String | An optional HTML signature that is included in messages composed with this alias in the Gmail web UI.
| host          | String | The hostname of the SMTP service.
| password      | String | The password that will be used for authentication with the SMTP service.
| port          | Number | The port of the SMTP service.
| securityMode  | Select | The protocol that will be used to secure communication with the SMTP service.
| username      | String | The username that will be used for authentication with the SMTP service. 
| treatAsAlias  | Boolean| Whether Gmail should treat this address as an alias for the user's primary email address. This setting only applies to custom "from" aliases.

## Gmail.getSendAsAliases
Lists the send-as aliases for the specified account. The result includes the primary send-as address associated with the account as well as any custom "from" aliases.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.getSingleSendAsAlias
 Gets the specified send-as alias.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| sendAsEmail| String| The send-as alias to be retrieved.
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.deleteSendAsAlias
 Deletes the specified send-as alias.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| sendAsEmail| String| The send-as alias to be retrieved.
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.verifySendAsAlias
 Verify the specified send-as alias.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| sendAsEmail| String| The send-as alias to be retrieved.
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.verifySendAsAlias
 Verify the specified send-as alias.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| sendAsEmail| String| The send-as alias to be retrieved.
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.getSendAsAliasSMIMEconfigs
Lists S/MIME configs for the specified send-as alias

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| sendAsEmail| String| The send-as alias to be retrieved.
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.getSendAsAliasSMIMEconfig
Get single S/MIME config for the specified send-as alias

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| sendAsEmail| String| The send-as alias to be retrieved.
| configId   | String| The immutable ID for the SmimeInfo.
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.getSendAsAliasSMIMEconfig
Get single S/MIME config for the specified send-as alias

| Field               | Type      | Description
|---------------------|-----------|----------
| accessToken         | String    | Token received from Gmail
| sendAsEmail         | String    | The send-as alias to be retrieved.
| email               | String    | The email of the user. The special value me can be used to indicate the authenticated user.
| expiration          | DatePicker| When the certificate expires (Y-m-d H:m:s).
| issuerCn            | String    | The S/MIME certificate issuer's common name.
| isDefault           | Boolean   | Whether this SmimeInfo is the default one for this user's send-as address.
| pem                 | String    | PEM formatted X509 concatenated certificate string (standard base64 encoding). Format used for returning key, which includes public key as well as certificate chain (not private key).
| pkcs12              | String    | PKCS#12 format containing a single private/public key pair and certificate chain. This format is only accepted from client for creating a new SmimeInfo and is never returned, because the private key is not intended to be exported. PKCS#12 may be encrypted, in which case encryptedKeyPassword should be set appropriately.
| encryptedKeyPassword| String    | Encrypted key password, when key is encrypted.

## Gmail.setSMIMEconfigAsDefault
Sets the default S/MIME config for the specified send-as alias.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| sendAsEmail| String| The send-as alias to be retrieved.
| configId   | String| The immutable ID for the SmimeInfo.
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.deleteSendAsAliasSMIMEconfig
Deletes the specified S/MIME config for the specified send-as alias.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Token received from Gmail
| sendAsEmail| String| The send-as alias to be retrieved.
| configId   | String| The immutable ID for the SmimeInfo.
| email      | String| The email of the user. The special value me can be used to indicate the authenticated user.

## Gmail.getMailboxHistory
Lists the history of all changes to the given mailbox. History results are returned in chronological order (increasing historyId)

| Field         | Type  | Description
|---------------|-------|----------
| accessToken   | String| Token received from Gmail
| startHistoryId| String| Returns history records after the specified startHistoryId. 
| historyTypes  | List  | The immutable ID for the SmimeInfo.
| labelId       | String| Only return messages with a label matching the ID.
| maxResults    | Number| The maximum number of history records to return.
| pageToken     | String| Page token to retrieve a specific page of results in the list.
| email         | String| The email of the user. The special value me can be used to indicate the authenticated user.

