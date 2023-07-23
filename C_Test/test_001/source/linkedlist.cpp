/*
 * linkedlist.cpp
 *
 *  Created on: 2021Äê11ÔÂ9ÈÕ
 *      Author: Administrator
 */

#include "linkedlist.hpp"
#define C_NODE_NUM  (10)
typedef struct LinkedListTestData TEST_DATA;
typedef TEST_DATA* LINK_LIST;

unsigned int linkedListMain(void)
{
	LINK_LIST pHead = NULL;
	LINK_LIST pNew  = NULL;
	LINK_LIST pCrr  = NULL;

	unsigned int ulLoop = 0;
	unsigned int ulCntr = 0;

	//Create and Initialize Node
	pNew        = (LINK_LIST)malloc(sizeof(TEST_DATA));
	pNew->ulNo  = 0;
	pNew->pNext = NULL;

	pHead       = pNew;

	for(ulLoop = 1; ulLoop < C_NODE_NUM; ulLoop++)
	{
		pCrr = pNew;
		pNew = (LINK_LIST)malloc(sizeof(TEST_DATA));
		pCrr->pNext = pNew;
		pNew->ulNo  = ulLoop;

		if(ulLoop + 1 == C_NODE_NUM)
		{
			pNew->pNext = NULL;
		}
		else
		{
			pNew->pNext = pCrr;
		}
	}

	//Count Node
	pCrr = pHead;
	while(1)
	{
		printf("No.:%d   %p    ",pCrr->ulNo,pCrr);
		pCrr   = pCrr->pNext;
		ulCntr = ulCntr+1;
		printf("Counter:%d\n",ulCntr);

		if(NULL == pCrr->pNext)
		{
			printf("No.:%d   %p    ",pCrr->ulNo,pCrr);
			ulCntr = ulCntr+1;
			printf("Counter:%d\n",ulCntr);
			break;
		}
	}

	return 0;
}

