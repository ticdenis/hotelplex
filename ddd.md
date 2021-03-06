.....................ENTITIES...............................................

hotel
	uuid: string
	name: string
	address: string
	phone: string
	email: string
	lift: boolean
	wifi: boolean
	accessibility: boolean
	parking: boolean
	kitchen: boolean
	pets: boolean
	payment methods: [string]
	logo: string
	images: [string]
	createdAt: Date
	updatedAt: Date

room
	uuid: string
	tv: boolean
	heating: boolean
	airConditioning: boolean
	wc: boolean
	shower: boolean
	wardrobe: boolean
	locker: boolean
	accessibility: boolean
	individualPrice: Amount
	individualBeds: [int]:[bool]
	doublePrice: Amount
	doubleBeds: [int:bool]
	images: [string]
	..createdAt: Date
	..updatedAt: Date

booking
	uuid: string
	customer: Customer
	room: Room
	paymentUUID: string
	checkIn: Date
	checkOut: Date
	createdAt: Date
	updatedAt: Date

user
	uuid: string
	username: string
	email: string
	password: string
	hotels: [string]
	createdAt: Date
	updatedAt: Date

provider
	uuid: string
	username: string
	email: string
	password: string
	createdAt: Date
	updatedAt: Date

customer | guest
	uuid: string
	firstname: string
	lastname: string
	phone: string
	email: string
	createdAt: Date
	updatedAt: Date

payment
	uuid: string
	paymentMethod: string
	amount: Amount // currency, price
	createdAt: Date

.....................USE CASES...............................................

........PUBLIC...........

~~RegisterProviderService: Given an username, email, password return an empty response.~~

~~TokenService: Given an username and password correctly returns a JWT with 14 days of expiration.~~

........PROTECTED...........

~~HotelsInfoService: Returns a list of hotels info that contains uuid, name, address, phone, email, lift, wifi, parking, kitchen, payment methods, pets, logo and images.~~

~~HotelInfoService: Given an uuid returns the hotel info that contains: uuid, name, address, phone, email, lift, wifi, parking, kitchen, payment methods, pets, logo and images.~~

BookingService: Given a customer (uuid, name, lastname, phone, email), a hotel (uuid) and the single and/or double beds (ids) of a room (uuid) the guests who will occupy the beds (uuid, name, lastname, phone, email), the date and time of check in and check out, final price (float) and payment (uuid) and returns the booking uuid if pass the three validations correctly.

BookingCustomerValidationService: Given a customer (uuid, name, lastname, phone, email) and hotel (uuid) returns a list of strings with the errors. If it's empty the validation pass otherwise not.

BookingRoomValidationService: Given a hotel (uuid) and the single and/or double beds (uuids) of a room (uuid) the guests who will occupy the beds (uuid, name, lastname, phone, email), the date and time of check in and check out can't have two bookings at the same time at the same hotel. Returns a list of strings with the errors. If it's empty the validation pass otherwise not.

BookingPaymentValidationService: Given a payment uuid and booking final price it will match with the database reference and bank response returns a list of strings with the errors. If it's empty the validation pass otherwise not.

BookingInfoService: Given an booking uuid returns a booking info that contains uuid, customer, room, dates and payment.

RoomListService: Given an uuid hotel, returns the room info that contains the room uuid, tv, heating, air conditioning, wc, show, wardrobe, locker, accesibility, images and individual and double beds as associative array (int: boolean).

RoomInfoService: Given an room uuid returns uuid, tv, heating, air conditioning, wc, show, wardrobe, locker, accessibility, images and individual and double beds as associative array (int: boolean).

GuestListService: Given a booking uuid returns a list of guest info that contains uuid, name, lastname, phone, email. If the requester it is an user then pass without ACL else check if provider did booking.

UpdateCustomerInfoService: Given a booking uuid, customer uuid, name, lastname, phone and email. If the requester it is an user then pass without ACL else check if provider did booking. After check in only users can modify it.

UpdateGuestInfoService: Given a booking uuid, guest uuid, name, lastname, phone and email. If the requester it is an user then pass without ACL else check if provider did booking.

MoveGuestService: Given a guest uuid, room uuid and individual or double bed.

RemoveAdditionalGuestService: Given a booking uuid and guest uuid. Only can remove when there is more than 1 guest.

........PRIVATE...........

~~̶R̶e̶g̶i̶s̶t̶e̶r̶U̶s̶e̶r̶S̶e̶r̶v̶i̶c̶e̶:̶ ̶G̶i̶v̶e̶n̶ ̶a̶n̶ ̶u̶s̶e̶r̶n̶a̶m̶e̶,̶ ̶e̶m̶a̶i̶l̶,̶ ̶p̶a̶s̶s̶w̶o̶r̶d̶ ̶a̶n̶d̶ ̶h̶i̶s̶ ̶h̶o̶t̶e̶l̶s̶ ̶a̶s̶s̶i̶g̶n̶e̶d̶ ̶r̶e̶t̶u̶r̶n̶ ̶a̶n̶ ̶e̶m̶p̶t̶y̶ ̶r̶e̶s̶p̶o̶n̶s̶e̶.~~

~~PaymentListService: Returns a list of payments info that contains uuid, paymentMethod, amount and createdAt.~~

~~PaymentInfoService: Given an uuid returns a payments info that contains uuid, paymentMethod, amount and createdAt.~~

AddRoomService: Given a booleans as tv, accessibility, heating, air conditioning, wc, shower, wardrobe, locker, individual and double price, individual and double beds and images.

RemoveRoomService: Given a room uuid.

CheckInService: Given a booking uuid and check in date.

CheckOutService: Given a booking uuid and check out date.
