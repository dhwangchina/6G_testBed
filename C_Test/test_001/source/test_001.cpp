/*
 * test_001.cpp
 *
 *  Created on: 2021.11.3.
 *      Author: Administrator
 */
#include "test_001.hpp"
#include "reverseInt.hpp"
#include "linkedlist.hpp"
#include "sort_Bubble.hpp"
#include "sort_Select.hpp"
#include "sort_quick.hpp"
#include "test_cpp17.hpp"
#include "test_cpp18.hpp"

using namespace std;

#define C_ARRAY_LEN  (10)
int main(void)
{
//	unsigned int ulVal = 123456789;
	unsigned int aulDataIn[C_ARRAY_LEN] = {10,3,22,4,66,5,57,9,98,10};
	unsigned int aulDataOut[C_ARRAY_LEN] = {'\0'};
	unsigned int ulIndex = 0;

//	reverseInt(ulVal);

//	linkedListMain();
#if 0
	printf("Original data:\n");
	for(ulIndex = 0; ulIndex < C_ARRAY_LEN; ulIndex++)
	{
		printf("%d  ",aulDataIn[ulIndex]);
	}
	printf("\n");
#endif
#if 0
	//Bubble Sort BGN
	sortBubble(aulDataIn,C_ARRAY_LEN,aulDataOut);
	printf("sortBubble data:\n");
	for(ulIndex = 0; ulIndex < C_ARRAY_LEN; ulIndex++)
	{
		printf("%d  ",aulDataOut[ulIndex]);
	}
	printf("\n");
#endif
	//Bubble Sort END

	//Select Sort BGN
#if 0
	memset((void*)aulDataOut,0, sizeof(aulDataOut));
	sortSelect(aulDataIn,C_ARRAY_LEN,aulDataOut);
	printf("sortSelect data:\n");
	for(ulIndex = 0; ulIndex < C_ARRAY_LEN; ulIndex++)
	{
		printf("%d  ",aulDataOut[ulIndex]);
	}
	printf("\n");
	//Select Sort END
#endif
#if 0
	//Quick sort BGN
	memset((void*)aulDataOut,0, sizeof(aulDataOut));
	sortQuick(aulDataIn,1,C_ARRAY_LEN);
	printf("sortQuick data:\n");
	for(ulIndex = 0; ulIndex < C_ARRAY_LEN; ulIndex++)
	{
		printf("%d  ",aulDataIn[ulIndex]);
	}
	printf("\n");
	//Quick sort End
#endif

//	test_cpp17();
	double sum = 0;
	int     sz = 6;
	sum = read_and_sum(sz);

	cout<<"Sum is "<<sum<<endl;
	return 0;
}


